<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$tempColumns = [
    'servers' => [
        'exclude' => 0,
        'config' => [
            'type' => 'select',
            'size' => 10,
            'minitems' => 0,
            'maxitems' => 99999,
            'foreign_table' => 'tx_varnishcache_domain_model_server',
            'MM' => 'tx_varnishcache_domain_model_server_sysdomain_mm',
            'MM_opposite_field' => 'domains'
        ]
    ],
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('sys_domain', $tempColumns);
