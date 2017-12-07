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

// Instantiate the app
$app = new Slim\App($settings);

// Set up dependencies
$container = $app->getContainer();
foreach ($dependencies as $key => $service) {
	$container["$key"] = $service;
}

// Register middleware

// Register routes
require("{$basePath}/kernel/routes.php");

// Run app
$app->run();