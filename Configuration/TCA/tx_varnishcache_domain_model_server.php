<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$languageFile = 'LLL:EXT:varnishcache/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => $languageFile . ':tx_varnishcache_domain_model_server.label',
        'label' => 'ip',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,
        'rootLevel' => -1,
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,',
        'iconfile' => 'EXT:varnishcache/Resources/Public/Icons/server.svg'
    ],
    'interface' => [
        'showRecordFieldList' => ' hidden, ip, port, method, protocol, strip_slashes, domains',
    ],
    'types' => [
        '1' => [
            'showitem' => 'hidden;;1,ip, port, method, protocol, strip_slashes, domains'
        ],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'ip' => [
            'exclude' => 1,
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.ip',
            'config' => [
                'type' => 'input',
                'size' => 255,
                'eval' => 'trim, required'
            ],
        ],
        'port' => [
            'exclude' => 1,
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.port',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'default' => 80,
                'eval' => 'trim,int'
            ],
        ],
        'method' => [
            'exclude' => 1,
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.method',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'default' => 'BAN',
                'eval' => 'trim, required'
            ],
        ],
        'protocol' => [
            'exclude' => 1,
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.protocol',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'size' => 1,
                'minitems' => 1,
                'items' => [
                    ['HTTP 1.0', '1'],
                    ['HTTP 1.1', '2']
                ],
                'eval' => 'trim'
            ],
        ],
        'strip_slahes' => [
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.strip_slashes',
            'config' => [
                'type' => 'check',
            ]
        ],
        'domains' => [
            'label' => $languageFile . ':tx_varnishcache_domain_model_server.domains',
            'exclude' => 0,
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'sys_domain',
                'MM' => 'tx_varnishcache_domain_model_server_sysdomain_mm',
                'size' => 10,
                'minitems' => 1,
                'maxitems' => 99999,
            ]
        ]
    ],
];
