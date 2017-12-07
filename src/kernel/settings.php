<?php
return [
  'settings' => [
    // set to false in production
    'displayErrorDetails' => true,

    // Allow the web server to send the content-length header
    'addContentLengthHeader' => false,

    // still learning
    'determineRouteBeforeAppMiddleware' => false,

    'db' => [
      'driver'    => 'pgsql',
      'host'      => getenv('DB_HOST'),
      'database'  => getenv('DB_NAME'),
      'username'  => getenv('DB_USER'),
      'password'  => getenv('DB_PASS'),
      'charset'   => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix'    => '',
      'port'      => 5432,
    ],

    // Renderer settings
    'renderer' => [
      'template_path' => __DIR__ . '/../../resource/templates/',
    ],

    // Monolog settings
    'logger' => [
      'name' => 'api-app',
      'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../../resource/logs/app.log',
      'level' => \Monolog\Logger::DEBUG,
    ],
  ],
];