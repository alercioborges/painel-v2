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

		$qtd = 5;
		$atual = isset($_GET['page']) ? intval($_GET['page']) : 1;
		$page = array_chunk($users, $qtd);
		$contar = count($page);
		$resultado = $page[$atual - 1];


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

		$return_api = $user->edit($data);		

		$validate->validateApi($return_api);

		return $response;
	}

	public function delete(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$return_api = $user->destroy($args['id']);

		$validate = new Validate();

		$validate->validateApi($return_api);

		return $response;
	}

	public function suspend(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$suspend = $user->suspend($args['id']);

		$validate = new Validate();

		$validate->validateApi($suspend);

		return $response;
	}

	public function unsuspend(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$unsuspend = $user->unsuspend($args['id']);

		$validate = new Validate();

		$validate->validateApi($unsuspend);

		return $response;
	}

	public function profile(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$user_data = $user->get($args['id']);

		$this->view('pages/users-profile.html', [
			'TITLE' => 'Página de perfil do usuários',
			'USER' => $user_data

		]);

		return $response;
	}

	public function resetPassword(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$user->redefinePassword($args['id']);		
		
		return $response;
	}

}