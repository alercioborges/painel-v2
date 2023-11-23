<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\src\Validate;
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

		$validate = new Validate();

		$data = $validate->validate([
			'username' => 'required',
			'password' => 'required',
			'firstname' => 'required',
			'lastname' => 'required',
			'email' => 'required'
		]);

		if ($validate->hasErrors()) {
			back();
		}

		dd($data);

		$user = new User();

		$user->save($_POST);
		
		return $response;
	}	
	
}