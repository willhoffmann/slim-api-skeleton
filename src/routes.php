<?php

$app->get('/ping', \App\Controller\PingController::class . ':getAction');

$app->group('/v1', function () {

    $this->group('/users', function () {
        $this->post('', \App\Controller\UserController::class . ':postAction');
        $this->put('', \App\Controller\UserController::class . ':putAction');
    });
});
