<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class UserController
{
	
	function show(Reques $request, Response $response, array $args): Response
	{
		echo "id do usuário é: " . $args['id'];
		return $response;
	}
	
}