<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/employees', function (Request $request, Response $response, array $args) {
  // Sample log message
  // $this->logger->info("Slim-Skeleton '/' route");

  $employees = $this->employee_service->getAll();

  // Render index view
  return $response->withJson($employees);
});
