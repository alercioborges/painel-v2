<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\src\Validate;
use app\models\User;

class UserController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$user = new User();
		
		$users = $user->getAll();

		$this->view('pages/users.html', [
			'TITLE' => 'Lissta de usuários',
			'USERS' => $users 

		]);

		return $response;
	}


	public function create(Reques $request, Response $response):Response
	{
		$this->view('pages/users-create.html', [
			'TITLE' => 'Cadastrar novo usuários',
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}

	public function save(Reques $request, Response $response):Response
	{
		$validate = new Validate();

		$data = $validate->validate([
			'username'	=> 'username:required:max@30',
			'password'	=> 'required:max@30',
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@60'
		]);

		$user = new User();

		$return_api = $user->save($data);

		$validate->validateApi($return_api);
		
		return $response;		
	}


	public function edit(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$user_data = $user->get($args['id']);



		$this->view('pages/users-update.html', [
			'TITLE' => 'Editar Cadastrastro de Usuário',
			'COOKIE_DATA' => $_COOKIE,
			'USER_DATA' => $user_data
		]);
		
		return $response;
	}


	public function update(Reques $request, Response $response):Response
	{
		$validate = new Validate();

		$data = $validate->validate([
			'username'	=> 'username:required:max@30',
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@60'
		]);

		$user = new User();

		$return_api = $user->update($data);		

		$validate->validateApi($return_api);

		return $response;
	}

	public function delete(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$return_api = $user->delete($args['id']);

		$validate = new Validate();

		$validate->validateApi($return_api);

		return $response;
	}
}