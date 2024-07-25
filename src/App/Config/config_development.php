<?php
// config/config_development.php
return [
    'logger' => [
        'files' => [
            'txt' => 'log_{DATE}.txt',
            'xml' => 'log_{DATE}.xml',
            'json' => 'log_{DATE}.json',
        ],
        'path' => '/var/www/Storage/logs/Development',

    ],
];
