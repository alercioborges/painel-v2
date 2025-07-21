<?php

use Middlewares\TrailingSlash;
use Slim\Factory\AppFactory;

use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;

use app\src\Middleware;

if (session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/app/config/database.php';

if (file_exists('.env')) {
	throw new \Exception("Error Processing Request", 1);	
}

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Criar aplicação Slim
$app = AppFactory::create();

// Adicionando diretório do dominio
if (isset($_ENV['APP_BASE_DIR'])) {
	$app->setBasePath($_ENV['APP_BASE_DIR']);
}

// Adiciona um Middleware as rotas
$app->addRoutingMiddleware();

// Middleware para trailing slash
$app->add(new TrailingSlash(false)); // Adiciona barra ao final

// Configurar Whoops para debug (apenas em desenvolvimento)
if (isset($_ENV['APP_ENV']) && $_ENV['APP_ENV'] === 'development') {
	$app->add(new WhoopsMiddleware());
}

// Configurar roteamento
$errorMiddleware = $app->addErrorMiddleware($_ENV['APP_DEBUG'], true, true);

$middleware = new Middleware();
