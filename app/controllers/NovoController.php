<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class NovoController
{
	
	function show(Reques $request, Response $response): Response
	{
		echo "Teste de rota Novo";
		return $response;
	}
	
}