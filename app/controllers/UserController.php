<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\models\User;

class UserController extends Controller
{
	
	public function create(Reques $request, Response $response): Response
	{
		$this->view('pages/user-create.html', [
			'TITLE' => 'Cadastrar novo usuários'
		]);

		return $response;
	}

	public function save(Reques $request, Response $response): Response
	{
		$user = new User();

		$x = $user->save($_POST);

		dd($x);

		return $response;
	}	
	
}