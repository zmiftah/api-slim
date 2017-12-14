<?php

use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\middleware\JWTMiddleware;
use zmdev\app\responder\auth\LoginAction;
use zmdev\app\responder\employee\IndexAction;
use zmdev\app\responder\employee\ViewAction;

// Responders

$container = $app->getContainer();

$container[LoginAction::class] = function($container) {
  return new LoginAction($container, null);
};
$container[IndexAction::class] = function($container) {
  return new IndexAction($container, $container['employee_service']);
};
$container[ViewAction::class] = function($container) {
  return new ViewAction($container, $container['employee_service']);
};

// Routes

$app->group('/v1', function() use ($app) {
	$app->group('/employee', function () {
	  $this->get('', IndexAction::class);
	  $this->get('/{id}', ViewAction::class);
	});
})->add(new JWTMiddleware);

$app->get('/login', LoginAction::class);