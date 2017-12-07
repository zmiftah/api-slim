<?php

// 
// Autoloading App
// 

// Base Path
$basePath = __DIR__;

// Load default settings via dotenv from file
$dotenv = new Dotenv\Dotenv("{$basePath}/../", '.env');
$dotenv->load();

// Load configs
$settings = require("{$basePath}/kernel/settings.php");
$dependencies = require("{$basePath}/kernel/dependencies.php");
$services = require("{$basePath}/kernel/services.php");

// Instantiate the app
$app = new Slim\App($settings);
$container = $app->getContainer();

// Set up dependencies
foreach ($dependencies as $key => $dependency) {
	$container["$key"] = $dependency;
}

// Register middleware

// Register services
foreach ($services as $key => $service) {
	$container["$key"] = $service;
}

// Set up Eloquent ConnectionResolver
$resolver = new Illuminate\Database\ConnectionResolver();
$resolver->addConnection('default', $container['db']->getConnection());
$resolver->setDefaultConnection('default');
Illuminate\Database\Eloquent\Model::setConnectionResolver($resolver);

// Register routes
require("{$basePath}/routes.php");

// Run app
$app->run();