<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SYS']['Objects']['TYPO3\\CMS\\Frontend\\ContentObject\\ContentObjectArrayInternalContentObject'] = array(
    'className' => \Filoucrackeur\Varnishcache\Frontend\ContentObject\ContentObjectArrayInternalContentObject::class
);


if (TYPO3_MODE === 'BE') {
    // On save page
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc'][] = \Filoucrackeur\Varnishcache\Hooks\DataHandler::class.'->clearCachePostProc';

    // On flush cache
    $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearPageCacheEval'][] = \Filoucrackeur\Varnishcache\Hooks\DataHandler::class.'->clearCachePostProc';
}
