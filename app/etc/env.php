<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'crypt' => [
        'key' => 'beeba37d97421ccc9257ff978613c2d3'
    ],
    'db' => [
        'table_prefix' => '',
        'connection' => [
            'default' => [
                'host' => 'localhost',
                'dbname' => 'magento2',
                'username' => 'root',
                'password' => 'root',
                'active' => '1'
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'developer',
    'session' => [
        'save' => 'files'
    ],
    'cache_types' => [
        'config' => 0,
        'layout' => 0,
        'block_html' => 0,
        'collections' => 0,
        'reflection' => 0,
        'db_ddl' => 0,
        'eav' => 0,
        'customer_notification' => 0,
        'config_integration' => 0,
        'config_integration_api' => 0,
        'full_page' => 0,
        'config_webservice' => 0,
        'translate' => 0,
        'compiled_config' => 0
    ],
    'install' => [
        'date' => 'Sun, 27 Jan 2019 14:19:49 +0000'
    ]
];
