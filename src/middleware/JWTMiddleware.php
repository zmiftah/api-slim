<?php

namespace zmdev\app\middleware;

use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class JWTMiddleware
{
  public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next)
  {
    $secretKey = getenv('SECRET_KEY');
  	$tokenAuth = $request->getHeader('token-auth');

  	if (empty($tokenAuth) || empty($tokenAuth[0])) {
  		return $response->withJson(['status'=>'error', 'text'=>'No token']);
  	}

  	$signer = new Sha256;
  	$token = (new Parser)->parse((string)$tokenAuth[0]);
  	if ($token->verify($signer, $secretKey) !== true) {
  		return $response->withJson(['status'=>'error', 'text'=>'No signature']);
  	}

  	$dataToken = new ValidationData;
  	$dataToken->setCurrentTime(time());
  	if ($token->validate($dataToken) !== true) {
			return $response->withJson(['status'=>'error', 'text'=>'Invalid token']);
  	}

  	return $next($request, $response);
  }
}