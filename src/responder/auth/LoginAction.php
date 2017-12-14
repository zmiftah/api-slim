<?php

namespace zmdev\app\responder\auth;

use Interop\Container\ContainerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use zmdev\app\base\ServiceInterface;

class LoginAction
{
  protected $container;

  public function __construct(ContainerInterface $container)
  {
    $this->container = $container;
  }

  public function __invoke(Request $request, Response $response, array $args)
  {
    $secretKey = getenv('SECRET_KEY');
    $tokenExpireTime = getenv('TOKEN_EXPIRE_TIME');

    $headerAuth = $request->getHeader('authentication');
    $headerStamp = $request->getHeader('timestamp');

    if (empty($headerAuth) || empty($headerStamp)) {
      return $response->withJson(['status'=>'error', 'text'=>'Headers not found']);
    }

    if (time() - $headerStamp[0] > $tokenExpireTime) {
      return $response->withJson(['status'=>'error', 'text'=>'The request exceeds the time limit of operation']);
    }

    if(strpos(strtoupper($headerAuth[0]), 'HMAC ') === false) {
      return $response->withJson(['status' => 'error', 'text' => 'Authentication header not found']);
    }

    $authKeySign = substr($headerAuth[0], 5);
    if (count(explode(':', $authKeySign)) !== 2) {
      return $response->withJson(['status' => 'error', 'text' => 'The authentication header is invalid']);
    }

    list($publicKey, $hmacSignature) = explode(':', $authKeySign);
    $apiKey = ApiKey::where('public_key', $publicKey)->first();
    if ($apiKey === null) {
      return $response->withJson(['status' => 'error', 'text' => 'Invalid public key']);
    }

    $payload = $request->getMethod() . '&';
    $payload .= $request->getUri()->getPath() . '&';
    $payload .= $headerStamp[0];
    $hash = hash_hmac('sha256', $payload, $apiKey->secret_key, false);
    if ($hmacSignature !== $hash) {
      return $response->withJson(['status' => 'error', 'text' => 'Invalid Signature']);
    }

    $signer = new Sha256;
    $token = (new Builder)->setIssuedAt(time())
      ->setExpiration(time() + $tokenExpireTime)
      ->sign($signer, $secretKey)
      ->getToken();

    return $response->withJson(['status' => 'ok', 'token' => (string)$token]);
  }
}