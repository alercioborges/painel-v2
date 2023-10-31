<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

require "../bootstrap.php";

$app->get('', 'app\controllers\OverviewController:index');
$app->get('/user/{id:[0-9]+}', 'app\controllers\UserController:show');
$app->get('/teste', 'app\controllers\TesteController:show');
$app->get('/novo', 'app\controllers\NovoController:show');
$app->get('/hi/{name}', 'app\controllers\HiController:show');


$app->run();