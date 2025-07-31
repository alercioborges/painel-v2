<?php

namespace app\src;

use Slim\App;
use Slim\Exception\HttpNotFoundException;
use Zeuxisoo\Whoops\Slim\WhoopsMiddleware;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ErrorMiddleware
{
    private $app;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function getErrorMiddleware(String $environment, bool $debug)
    {
        // Configurar Whoops para debug (apenas em desenvolvimento)
        if ($environment === 'development') {
            $this->app->add(new WhoopsMiddleware([
                'enable' => true,
                'editor' => 'vscode',
                'title'  => 'Aplication error'
            ]));
        } else {

            $errorMiddleware = $this->app->addErrorMiddleware($debug, true, true);

            $app = $this->app;

            $errorMiddleware->setErrorHandler(
                HttpNotFoundException::class,
                function (Request $request, \Throwable $exception, bool $displayErrorDetails) use ($app): Response {
                    $response = $this->app->getResponseFactory()->createResponse(404);

                    // Carregar arquivo HTML externo
                    $htmlFile = dirname(__DIR__) . '/views/templates/pages/404.html';

                    $html = file_get_contents($htmlFile);

                    $response->getBody()->write($html);
                    return $response->withHeader('Content-Type', 'text/html');
                }
            );
        }
    }
}
