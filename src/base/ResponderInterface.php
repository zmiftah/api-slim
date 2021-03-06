<?php

namespace zmdev\app\base;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\base\ServiceInterface;

interface ResponderInterface
{
	public function __construct(ContainerInterface $container, ServiceInterface $service);
}