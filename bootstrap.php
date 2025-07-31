<?php

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;
use DI\Container;

use app\config\App;
use app\src\Middleware;
use app\src\ErrorMiddleware;
use DI\ContainerBuilder;

if (!session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Criar aplicação Slim
$app = AppFactory::create();

$container = new ContainerBuilder();

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
$errorMdwr->getErrorMiddleware(App::config()->get('env'), App::config()->get('debug'));

$middleware = new Middleware();
