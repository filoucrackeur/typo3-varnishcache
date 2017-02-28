<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$tempColumns = [
    'exclude_from_cache' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:varnishcache/Resources/Private/Language/locallang_db.xlf:tt_content.exclude_from_cache',
        'config' => [
            'type' => 'check',
        ]
    ],
    'ttl' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:varnishcache/Resources/Private/Language/locallang_db.xlf:tt_content.ttl',
        'config' => [
            'type' => 'input',
            'size' => 2,
            'default' => 0,
            'eval' => 'int',
            'range' => [
                'lower' => 0,
                'upper' => 365
            ],
            'wizards' => [
                'slider' => [
                    'type' => 'slider',
                    'step' => 1
                ]
            ]
        ]
    ],
    'ttl_unit' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:varnishcache/Resources/Private/Language/locallang_db.xlf:tt_content.ttl_unit',
        'config' => [
            'type' => 'select',
            'default' => 's',
            'items' => [
                0 => ['millisecondes','ms'],
                1 => ['secondes','s'],
                2 => ['minutes','m'],
                3 => ['hours','h'],
                4 => ['days','d'],
                5 => ['weeks','w'],
                6 => ['years','y'],
            ]
        ]
    ],
    'alternative_content' => [
        'exclude' => 1,
        'label' => 'LLL:EXT:varnishcache/Resources/Private/Language/locallang_db.xlf:tt_content.alternative_content',
        'config' => [
            'type' => 'group',
            'internal_type' => 'db',
            'allowed' => 'tt_content',
            'size' => 1,
            'wizards' => [
                'suggest' => [
                    'type' => 'suggest'
                ],
            ],
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('tt_content', '--div--;Varnish Cache,exclude_from_cache, ttl,ttl_unit, alternative_content');
