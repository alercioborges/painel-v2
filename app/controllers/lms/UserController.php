<?php

namespace app\controllers\lms;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\src\Validate;
use app\models\lms\User;

class UserController extends Controller
{	
	public function show(Reques $request, Response $response):Response
	{		
		$user = new User();

		$render['TITLE'] = 'Lissta de usuários';
		$pathPage = 'pages/lms/users.html';

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
		$this->view('pages/lms/user-create.html', [
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
		
		try{
			
			$return_api = $user->save($data);
			$validate->validateApi($return_api);

		} catch (\Exception $e) {

			flash('api_error', error($e->getMessage()));
			redirect('/lms/users');

		}

		return $response;

	}


	public function edit(Reques $request, Response $response, array $args):Response
	{
		$user = new User();

		$render['TITLE'] = 'Editar Cadastrastro de Usuário';
		$pathPage = 'pages/lms/user-update.html';		

		try{

			$user_data = $user->get($args['id']);

			$render['COOKIE_DATA'] = $_COOKIE;
			$render['USER_DATA'] = $user_data;			

			$this->view($pathPage, $render);

		} catch (\Exception $e) {

			flash('api_error', error($e->getMessage()));			
			$this->view($pathPage, $render);		

		}
		
		return $response;

	}


	public function update(Reques $request, Response $response, array $args)
	{
		$validate = new Validate();
		
		$data = $validate->validate([
			'username'	=> 'username:required:max@30',
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@60'
		]);

		$user = new User();			

		try{
			
			$return_api = $user->edit($data);
			$validate->validateApi($return_api);

		} catch (\Exception $e) {

			flash('api_error', error($e->getMessage()));
			redirect('/lms/users');

		}
		
	}


	public function profile(Reques $request, Response $response, array $args):Response
	{
		$render['TITLE'] = 'Página de perfil do usuários';
		$pathPage = 'pages/lms/user-profile.html';

		$user = new User();

		try{

			$user_data = $user->get($args['id']);

			$render['USER'] = $user_data;

			$this->view($pathPage, $render);

		} catch (\Exception $e) {

			flash('api_error', error($e->getMessage()));
			$this->view($pathPage, $render);

		}

		return $response;
	}


	public function resetPassword(Reques $request, Response $response, array $args)
	{
		$user = new User();

		try{

			if ($user->redefinePassword($args['id'])) {
				flash('success', success('E-mail de redefinição de senha enviado com sucesso!'));
			}

		} catch (\Exception $e) {
			flash('api_error', error($e->getMessage()));
		}

		redirect("/lms/users/{$args['id']}/profile");
	}

}