<?php

use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\responder\employee\IndexAction;
use zmdev\app\responder\employee\ViewAction;

// Responders

$container = $app->getContainer();
$container[IndexAction::class] = function($container) {
  return new IndexAction($container, $container['employee_service']);
};
$container[ViewAction::class] = function($container) {
  return new ViewAction($container, $container['employee_service']);
};

// Routes

$app->group('/employee', function () {
  $this->get('', IndexAction::class);
  $this->get('/{id}', ViewAction::class);
});
