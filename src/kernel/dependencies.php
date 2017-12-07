<?php
// DIC configuration

return [
  // database
  'db' => function($container) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($container['settings']['db'], 'default');
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
  },
  // view renderer
  'renderer' => function ($container) {
    $settings = $container['settings']['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
  },
  // monolog
  'logger' => function ($container) {
    $settings = $container['settings']['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
  },
];