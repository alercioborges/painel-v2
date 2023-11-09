<?php

session_start();

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;
use app\Config;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath(Config::BASE_DIR);

$app->addRoutingMiddleware();

$app->add(new TrailingSlash(false));

$errorMiddleware = $app->addErrorMiddleware(true, true, true);