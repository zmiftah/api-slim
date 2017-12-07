<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/employees', function (Request $request, Response $response, array $args) use ($app) {
  // Sample log message
  // $this->logger->info("Slim-Skeleton '/' route");

  // var_dump($app->getContainer()['db']);

  // $table = $app->getContainer()['db']->table('sdm_employee');
  // var_dump($table->first());

  $employees = $this->employee_service->getAll();

  // Render response
  return $response->withJson($employees);
});
