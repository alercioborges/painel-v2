<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\Teste;

class TesteController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$teste = new Teste();
		
		$this->view('pages/teste.html', [
			'TITLE' => 'Teste'
		]);

		$users = $teste->testando();

		dd($users);

		return $response;

	}

}