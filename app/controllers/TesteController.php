<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class TesteController
{
	
	function show(Reques $request, Response $response): Response
	{
		echo "Teste de rota";
		return $response;
	}
	
}