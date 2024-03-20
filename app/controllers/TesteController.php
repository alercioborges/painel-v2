<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

class TesteController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{		
		$this->view('pages/teste.html', [
			'TITLE' => 'Teste'
		]);
		
		return $response;

	}

}