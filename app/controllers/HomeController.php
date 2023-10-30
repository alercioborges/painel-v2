<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class HomeController
{
	
	function index(Reques $request, Response $response): Response
	{		
		echo "index HomeController";
		return $response;
	}
}