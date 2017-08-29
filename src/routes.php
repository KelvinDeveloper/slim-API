<?php
// Routes

$app->post('/auth', 'App\Controllers\Auth\AuthController:Auth');

$app->group('/api/v1/', function () {

    $this->get('{interface}/index', 'App\Controllers\ApiController:index');

    $this->post('{interface}/store', 'App\Controllers\ApiController:store');

    $this->put('{interface}/update', 'App\Controllers\ApiController:update');

    $this->delete('{interface}/delete', 'App\Controllers\ApiController:delete');

})->add($JWT);