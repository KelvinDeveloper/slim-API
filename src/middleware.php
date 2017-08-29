<?php

// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

$JWT = function ($request, $response, $next) {

    $Token = str_replace('Bearer ', '', $request->getServerParam('HTTP_AUTHORIZATION'));

    $Decoded = \Firebase\JWT\JWT::decode($Token, env('JWT_KEY'), ['HS256']);

    if (! $Decoded ) throw new \Exception('Invalid token');

    $Auth = new \App\Controllers\Auth\AuthController;
    $Auth->Login(\App\Models\User::find($Decoded->id));

    return $next($request, $response);
};