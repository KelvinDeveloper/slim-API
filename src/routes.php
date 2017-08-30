<?php
// Routes

$app->post('/auth', 'App\Controllers\Auth\AuthController:Auth');

$app->group('/api/v1/', function () {

    $this->get('{interface}[/[{id}]]', 'App\Controllers\ApiController:index');

    $this->post('{interface}', 'App\Controllers\ApiController:store');

    $this->put('{interface}/{id}', 'App\Controllers\ApiController:update');

    $this->delete('{interface}/{id}', 'App\Controllers\ApiController:delete');

})->add($JWT);