<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use core\Database;

use app\models\User;

class TesteController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$conn = Database::getInstance(); 
		
		$this->view('pages/teste.html', [
			'TITLE' => 'Teste'
		]);

		$data = mdl_user::select()->where('email', 'alercio@email.com')->execute();

		/*
		SELECT
			c.value
		FROM mdl_config c
		WHERE c.name = 'siteadmins'
		*/

		return $response;

	}

}