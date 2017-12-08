<?php

namespace zmdev\app\base;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\base\ServiceInterface;

interface ActionInterface
{
	public function __construct(ContainerInterface $container, ServiceInterface $service);

	public function __invoke(Request $request, Response $response, array $args);
}