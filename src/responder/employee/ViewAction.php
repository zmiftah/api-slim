<?php

namespace zmdev\app\responder\employee;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\base\ActionInterface;
use zmdev\app\base\ServiceInterface;

class ViewAction implements ActionInterface
{
	protected $container;
	protected $service;

	public function __construct(ContainerInterface $container, ServiceInterface $service)
	{
		$this->container = $container;
		$this->service = $service;
	}

	public function __invoke(Request $request, Response $response, array $args)
	{
		$employee = $this->service->findOne((int)$args['id']);
		return $response->withJson($employee);
	}
}