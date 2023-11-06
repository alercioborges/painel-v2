<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\models\User;

class TesteController extends Controller
{
	
	public function show(Reques $request, Response $response): Response
	{
		$user = new User();

		$users = $user->getAll();

		$this->view('pages/teste.html', [
			'TITLE' => 'Usuários',
			'USERS' => $users 

		]);
		return $response;
	}
	
}