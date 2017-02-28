<?php
namespace Filoucrackeur\Varnishcache\Service;

use Filoucrackeur\Varnishcache\Domain\Model\Server;
use Filoucrackeur\Varnishcache\Domain\Model\SysDomain;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;

class VarnishCacheService
{

    /**
     * @var \Filoucrackeur\Varnishcache\Service\FrontendUrlGenerator
     * @inject
     */
    protected $frontendUrlGenerator;

    /**
     * @var \Filoucrackeur\Varnishcache\Domain\Repository\SysDomainRepository
     * @inject
     */
    protected $domainRepository;

    /**
     * Flush cache for every found domain and given varnish server
     *
     * @param int $currentPageId
     * @return bool
     */
    public function flushCache(int $currentPageId)
    {
        $url = $this->frontendUrlGenerator->getFrontendUrl($currentPageId);

        if ($currentPageId > 0) {
            $domains = $this->domainRepository->findByRootLine(BackendUtility::BEgetRootLine($currentPageId));
        } else {
            $domains = $this->domainRepository->findAll();
        }

        if ($domains) {
            /* @var $domain SysDomain */
            foreach ($domains as $domain) {
                if ($servers = $domain->getServers()) {
                    /* @var $server Server */
                    foreach ($servers as $server) {
                        $this->request($domain, $server, $url);
                    }
                }
            }
            return TRUE;
        }
        return FALSE;
    }

    /**
     * Send curl request
     *
     * @param SysDomain $domain
     * @param Server $server
     * @param $frontendUrl
     * @return mixed
     */
    protected function request(SysDomain $domain, Server $server, $frontendUrl)
    {

        if (!function_exists('curl_version')) {
            throw new \BadFunctionCallException('Curl is required but not loaded', '1444895510');
        }

        if ($server->isStripSlashes()) {
            $frontendUrl = rtrim($frontendUrl, '/');
        }

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_NOBODY, 1);
        curl_setopt($curl, CURLOPT_PORT, $server->getPort());
        curl_setopt($curl, CURLOPT_URL, $server->getRequestUrlByFrontendUrl($frontendUrl));
        curl_setopt($curl, CURLOPT_HTTP_VERSION, ($server->getProtocol() == 1) ? CURL_HTTP_VERSION_1_0 : CURL_HTTP_VERSION_1_1);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $server->getMethod());

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'X-Host: ' . $domain->getDomainName(),
            'X-Url: ' . $frontendUrl,
        ));
        curl_setopt($curl, CURLINFO_HEADER_OUT, 1);
        $header = curl_exec($curl);
        curl_close($curl);

        $this->getBackendUser()->writelog(3, 1, 0, 0, 'User %s has cleared the varnishcache (server=%s,host=%s, url=%s)', array($this->getBackendUser()->user['username'], $server->getIp(), $domain->getDomainName(), $frontendUrl));

        return $header;

    }


    /**
     * @return BackendUserAuthentication
     */
    protected function getBackendUser()
    {
        return $GLOBALS['BE_USER'];
    }
}
