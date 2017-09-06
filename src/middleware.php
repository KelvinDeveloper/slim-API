<?php

// Application middleware

$JWT = function ($request, $response, $next) {

    $Token = str_replace('Bearer ', '', $request->getServerParam('HTTP_AUTHORIZATION'));

    $Decoded = \Firebase\JWT\JWT::decode($Token, env('JWT_KEY'), ['HS256']);

    if (! $Decoded ) throw new \Exception('Invalid token');

    $Auth = new \App\Controllers\Auth\AuthController;
    $Auth->Login(\App\Models\User::find($Decoded->id));

    return $next($request, $response);
};

$app->add(function ($request, $response, $next) {

    $response = $next($request, $response);

    return $response
        ->withHeader('Access-Control-Allow-Origin', "{$request->getUri()->getScheme()}://{$request->getUri()->getHost()}")
        ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
        ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
});