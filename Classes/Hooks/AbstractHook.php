<?php
namespace Filoucrackeur\Varnishcache\Hooks;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
abstract class AbstractHook {
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * StdWrap constructor.
     */
    public function __construct() {
        /* @var $objectManager ObjectManager */
        $this->objectManager = GeneralUtility::makeInstance(ObjectManager::class);
    }
}
