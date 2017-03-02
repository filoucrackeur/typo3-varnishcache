<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects'][\TYPO3\CMS\Frontend\ContentObject\ContentObjectArrayInternalContentObject::class] = [
    'className' => \Filoucrackeur\Varnishcache\Frontend\ContentObject\ContentObjectArrayInternalContentObject::class
];
