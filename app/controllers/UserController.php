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

		$render['TITLE'] = 'Lissta de usuários';
		$pathPage = 'pages/users.html';

		try {

			$users = $user->getAll(30);
			
			$render['USERS'] = $users['USERS'];
			$render['PAGES'] = $users['PAGES'];

			$this->view($pathPage, $render);

		} catch (\Exception $e) {

			flash('api_error', error($e->getMessage()));			
			$this->view($pathPage, $render);
			
		}

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

	public function save(Reques $request)
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


	public function update(Reques $request)
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
		
	}

	public function delete(Reques $request, Response $response, array $args)
	{
		$user = new User();

		$return_api = $user->destroy($args['id']);

		$validate = new Validate();

		$validate->validateApi($return_api);

	}

	public function suspend(Reques $request, Response $response, array $args)
	{
		$user = new User();

		$suspend = $user->suspend($args['id']);

		$validate = new Validate();

		$validate->validateApi($suspend);

	}

	public function unsuspend(Reques $request, Response $response, array $args)
	{
		$user = new User();

		$unsuspend = $user->unsuspend($args['id']);

		$validate = new Validate();

		$validate->validateApi($unsuspend);

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

	public function resetPassword(Reques $request, Response $response, array $args)
	{
		$user = new User();

		$user->redefinePassword($args['id']);

	}

}