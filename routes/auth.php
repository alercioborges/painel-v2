<?php

use app\controllers\LoginController;

// auth rotes
$app->get('/login', [LoginController::class, 'index'])->setName('login');
$app->post('/login', [LoginController::class, 'login']);
$app->get('/logout', [LoginController::class, 'logout']);