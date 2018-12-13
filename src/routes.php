<?php

$app->get('/ping', \App\Controller\PingController::class . ':getAction');
