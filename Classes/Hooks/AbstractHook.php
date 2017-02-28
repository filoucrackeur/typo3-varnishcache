<?php
namespace Filoucrackeur\Varnishcache\Hooks;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;

abstract class AbstractHook {

    /**
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;
}
