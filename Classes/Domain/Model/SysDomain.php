<?php
namespace Filoucrackeur\Varnishcache\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;


class SysDomain extends AbstractDomainObject {

    /**
     * @var string
     */
    protected $domainName;

    /**
     * @var string
     */
    protected $redirectTo;

    /**
     * @var integer
     */
    protected $redirectHttpStatusCode;

    /**
     * @var boolean
     */
    protected $forced;

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\Filoucrackeur\Varnishcache\Domain\Model\Server>
     */
    protected $servers;

    /**
     * SysDomain constructor.
     */
    public function __construct() {
        $this->servers = new ObjectStorage();
    }


    /**
     * @return string
     */
    public function getDomainName() {
        return $this->domainName;
    }

    /**
     * @param string $domainName
     */
    public function setDomainName($domainName) {
        $this->domainName = $domainName;
    }

    /**
     * @return string
     */
    public function getRedirectTo() {
        return $this->redirectTo;
    }

    /**
     * @param string $redirectTo
     */
    public function setRedirectTo($redirectTo) {
        $this->redirectTo = $redirectTo;
    }

    /**
     * @return int
     */
    public function getRedirectHttpStatusCode() {
        return $this->redirectHttpStatusCode;
    }

    /**
     * @param int $redirectHttpStatusCode
     */
    public function setRedirectHttpStatusCode($redirectHttpStatusCode) {
        $this->redirectHttpStatusCode = $redirectHttpStatusCode;
    }

    /**
     * @return boolean
     */
    public function isForced() {
        return $this->forced;
    }

    /**
     * @param boolean $forced
     */
    public function setForced($forced) {
        $this->forced = $forced;
    }

    /**
     * @return ObjectStorage
     */
    public function getServers() {
        return $this->servers;
    }

    /**
     * @param ObjectStorage $servers
     */
    public function setServers($servers) {
        $this->servers = $servers;
    }

    public function addServer(Server $server) {
        $this->servers->attach($server);
    }

    public function removeServer(Server $server) {
        $this->servers->detach($server);
    }
}
