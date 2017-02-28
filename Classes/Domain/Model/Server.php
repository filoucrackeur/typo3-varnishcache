<?php
namespace Filoucrackeur\Varnishcache\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Server extends AbstractDomainObject
{
    /**
     * @var string
     */
    protected $ip;

    /**
     * @var integer
     */
    protected $port;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $protocol;

    /**
     * @var boolean
     */
    protected $stripSlashes;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Filoucrackeur\Varnishcache\Domain\Model\SysDomain>
     */
    protected $domains;

    /**
     * VarnishServer constructor.
     */
    public function __construct()
    {
        $this->domains = new ObjectStorage();
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getProtocol()
    {
        return $this->protocol;
    }

    /**
     * @param string $protocol
     */
    public function setProtocol($protocol)
    {
        $this->protocol = $protocol;
    }

    /**
     * @return boolean
     */
    public function isStripSlashes()
    {
        return $this->stripSlashes;
    }

    /**
     * @param boolean $stripSlashes
     */
    public function setStripSlashes($stripSlashes)
    {
        $this->stripSlashes = $stripSlashes;
    }

    /**
     * @return ObjectStorage
     */
    public function getDomains()
    {
        return $this->domains;
    }

    /**
     * @param ObjectStorage $domains
     */
    public function setDomains($domains)
    {
        $this->domains = $domains;
    }

    /**
     * @param \Filoucrackeur\Varnishcache\Domain\Model\SysDomain $domain
     */
    public function addDomain(SysDomain $domain)
    {
        $this->domains->attach($domain);
    }

    /**
     * @param \Filoucrackeur\Varnishcache\Domain\Model\SysDomain $domain
     */
    public function removeDomain(SysDomain $domain)
    {
        $this->domains->detach($domain);
    }

    /**
     * Returns request url for curl
     *
     * @param $frontendUrl
     * @return string
     */
    public function getRequestUrlByFrontendUrl($frontendUrl)
    {
        return $this->getIp() . '/' . ltrim($frontendUrl, '/');
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp($ip)
    {
        $this->ip = $ip;
    }

}
