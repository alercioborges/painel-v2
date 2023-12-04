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
			'TITLE' => 'Cadastrar novo usuários',
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}

	public function save(Reques $request, Response $response): Response
	{

		$user = new User();

		$return_api = $user->save($_POST);

		$validate = new Validate($return_api);

		$data = $validate->validate([
			'username'	=> 'username:required:max@30',
			'password'	=> 'required:max@30',
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@30'
		]);
		
		return $response;		
	}	

}