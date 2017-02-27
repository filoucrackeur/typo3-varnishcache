<?php
/* * *************************************************************
 *  Copyright notice
 *
 *  (C) 2015 Filoucrackeur CM Service GmbH & Co. KG <opensource@filoucrackeur.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 * ************************************************************* */

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
                0 => ['secondes','s'],
                1 => ['minutes','m'],
                2 => ['hours','h'],
                3 => ['days','d'],
                4 => ['weeks','w'],
                5 => ['years','y'],
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
