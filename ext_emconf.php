<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'TYPO3 Varnish',
    'description' => 'This extension provides varnish functionality to TYPO3 instances. Use ESI-Tags and clear varnish cache from TYPO3.',
    'category' => 'plugin',
    'author' => 'Philippe Court',
    'author_company' => 'Web Station Service',
    'author_email' => 'contact@webstationservice.fr',
    'dependencies' => 'extbase,fluid',
    'state' => 'stable',
    'clearCacheOnLoad' => '1',
    'version' => '1.0.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-8.99.99',
            'extbase' => '6.2.0-8.99.99',
            'fluid' => '6.2.0-8.99.99',
        ]
    ],
    'autoload' => [
        'psr-4' => [
            'Filoucrackeur\\Varnishcache\\' => 'Classes',
        ],
    ],
    'autoload-dev' => [
        'psr-4' => [
            'Filoucrackeur\Varnishcache\\Tests\\' => 'Tests',
        ],
    ],
];
