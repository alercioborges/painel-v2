<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\models\User;

class UsersController extends Controller
{
	
	public function show(Reques $request, Response $response): Response
	{
		$user = new User();

		$users = $user->getAll();

		$this->view('pages/users.html', [
			'TITLE' => 'Lissta de usuários',
			'USERS' => $users 

		]);

		return $response;
	}	
}