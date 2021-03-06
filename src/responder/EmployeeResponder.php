<?php

namespace zmdev\app\responder;

use Interop\Container\ContainerInterface;
use Slim\Http\Response;
use zmdev\app\base\ResponderInterface;
use zmdev\app\base\ServiceInterface;

class EmployeeResponder implements ResponderInterface
{
	protected $container;
	protected $service;

	public function __construct(ContainerInterface $container, ServiceInterface $service)
	{
		$this->container = $container;
		$this->service = $service;
	}

	public function index(Response $response)
	{
		$employees = $this->service->findAll();
		return $response->withJson($employees);
	}

	public function view(Response $response, int $id)
	{
		$employee = $this->service->findOne($id);
		return $response->withJson($employee);
	}
}