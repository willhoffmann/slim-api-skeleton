<?php
/**
 * Settings
 */

// Get database doctrine local
$ini = parse_ini_file(__DIR__ . '/../config/doctrine.local.ini');

return [
    'settings' => [
        'displayErrorDetails' => getenv('APP_DEBUG'), // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Monolog settings
        'logger' => [
            'name' => getenv('APP_NAME'),
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../data/logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Doctrine settings
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'src/Entity'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' => __DIR__ . '/../data/doctrine/proxy',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => $ini['driv'],
                'host'     => $ini['host'],
                'port'     => $ini['port'],
                'dbname'   => $ini['name'],
                'user'     => $ini['user'],
                'password' => $ini['pass'],
            ],
        ],
    ],
];
