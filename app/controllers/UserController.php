<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\User;
use app\models\Role;
use app\src\Validate;

class UserController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$user = new User();

		$users = $user->getAll(30);
		
		$this->view('pages/users.html', [
			'TITLE' => 'Lissta de usuários',
			'USERS' => $users['USERS'],
			'PAGES' => $users['PAGES']
		]);

		return $response;

	}


	public function create(Reques $request, Response $response):Response
	{
		$role = new Role();

		$roles = $role->getRoles();
		dd($roles);
		$this->view('pages/user-create.html', [
			'TITLE' => 'Cadastrar novo usuário',
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}

	public function save(Reques $request)
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30:uppercase',
			'lastname'	=> 'required:max@30:uppercase',
			'email'		=> 'email:required:max@60:unique@user',
			'role' 		=> 'required',
			'password' 	=> 'required:max@30'
		]);
		dd($data);
		$user = new User();

		$user = $user->save($data);

		flash('success', success("Usuário criado com sucesso"));
		redirect("/admin/users");

	}


	public function edit(Reques $request, Response $response, array $args):Response
	{
		$admin = new User();

		$admin = $admin->get($args['id']);

		$this->view('pages/admins-update.html', [
			'TITLE' => 'Editar Cadastrar de administrador',
			'ADMIN' => $admin,
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}

	public function update(Reques $request, Response $response, array $args):Response
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30:uppercase',
			'lastname'	=> 'required:max@30:uppercase',
			'email'		=> "email:required:max@60:unique@user({$args['id']})"
		]);
		
		$admin = new UUser();

		$admin = $admin->edit($args['id'], $data);

		flash('success', success("Cadastro de administrador alterado com sucesso"));
		redirect("/admin/users");
		
		return $response;
	}


	public function delete(Reques $request, Response $response, array $args):Response
	{
		$admin = new User();

		$deleted = $admin->destroy($args['id']);

		if ($deleted == 1) {
			flash('success', success("Usuário exclído com sucesso"));
			redirect("/admin/users");
		}

		return $response;
		
	}

}