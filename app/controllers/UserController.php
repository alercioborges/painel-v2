<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use core\Controller;

use app\models\User;
use app\models\Role;
use app\src\Validate;

class UserController extends Controller
{

	public function show(Request $request, Response $response):Response
	{
		$user = new User();

		$perPage = 3;

		$users = isset($_GET['search'])
		? $user->filtered(['firstname', 'lastname', 'email'], $_GET['search'], $perPage)
		: $user->getAll($perPage);

		$this->view('pages/users.html', [
			'TITLE' => 'Lissta de usuários',
			'USERS' => $users['USERS'],
			'PAGES' => $users['PAGES']
		]);		

		return $response;

	}



	public function create(Request $request, Response $response):Response
	{
		$role = new Role();

		try {	
			$roles = $role->getRoles();			
		} catch (\Exception $e) {
			flash('message', error($e->getMessage()));
			redirect('/admin/users');
		}
		
		$this->view('pages/user-create.html', [
			'TITLE' => 'Cadastrar novo usuário',
			'ROLES' => $roles,
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}



	public function save()
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30:uppercase',
			'lastname'	=> 'required:max@30:uppercase',
			'email'		=> 'email:required:max@60:unique@user',
			'role_id' 	=> 'required',
			'password' 	=> 'required:max@30'
		]);

		$user = new User();

		try {
			$user = $user->save($data);			
		} catch (Exception $e) {
			flash('message', error("Erro ao tentar cadastrar usuário: $e->getMessage()"));
		}

		redirect('/admin/users');
	}



	public function edit(Request $request, Response $response, array $args):Response
	{
		$user = new User();

		try {
			$user = $user->get($args['id']);
		} catch (\Exception $e) {
			flash('message', error($e->getMessage()));
			redirect('/admin/users');
		}

		$role = new Role();
		$roles = $role->getRoles();

		$this->view('pages/user-update.html', [
			'TITLE' => 'Editar Cadastrar de usuário',
			'USER' => $user,
			'ROLES'	=> $roles,
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}



	public function update(Request $request, Response $response, array $args):Response
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30:uppercase',
			'lastname'	=> 'required:max@30:uppercase',
			'email'		=> "email:required:max@60:unique@user({$args['id']})",
			'role_id' 	=> 'required'
		]);

		$user = new User();

		try {
			$user = $user->edit($args['id'], $data);
			flash('message', success("Cadastro de Usuário alterado com sucesso"));			
		} catch (\Exception $e) {
			flash('message', error("Erro ao tentar edupar usuário usuário: {$e->getMessage()}"));
		}

		redirect("/admin/users");

		return $response;
	}



	public function delete(Request $request, Response $response, array $args):Response
	{
		$user = new User();

		try {
			$user->destroy($args['id']);
			flash('message', success("Usuário exclído com sucesso"));
		} catch (Exception $e) {
			flash('message', error("Erro ao excluir usuário: {$e->getMessage()}"));
		}
		
		redirect("/admin/users");

		return $response;
	}

}