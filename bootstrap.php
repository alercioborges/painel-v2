<?php

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

use app\config\App;
use app\src\Middleware;
use app\src\ErrorMiddleware;

if (!session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Criar aplicação Slim
$app = AppFactory::create();

// Adicionando diretório do dominio
if (!empty(App::config()->get('dir'))) {
	$app->setBasePath(App::config()->get('dir'));
}

// Adiciona um Middleware as rotas
$app->addRoutingMiddleware();

// Middleware para trailing slash
$app->add(new TrailingSlash(false)); // Adiciona barra ao final

// Carrega os tipo de menssagens de etto
$errorMdwr = new ErrorMiddleware($app);
$errorMdwr->setErrorMiddleware(App::config()->get('env'), App::config()->get('debug'));

$middleware = new Middleware();
