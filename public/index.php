<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require "../bootstrap.php";

$app->get('', 'app\controllers\OverviewController:index');
$app->get('/users/{id:[0-9]+}', 'app\controllers\UserController:show');
$app->get('/teste', 'app\controllers\TesteController:show');
$app->get('/novo', 'app\controllers\NovoController:show');
$app->get('/hi/{name}', 'app\controllers\HiController:show');
$app->get('/users/create', 'app\controllers\UserController:create');
$app->post('/users/create', 'app\controllers\UserController:save');

$app->run();