<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\Administrator;
use app\src\Validate;

class AdministratorController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$admin = new Administrator();

		$admins = $admin->getAll(2);

		$this->view('pages/admins.html', [
			'TITLE' => 'Lissta de administradores',
			'ADMINS' => $admins['ADMINS'],
			'PAGES' => $admins['PAGES']
		]);

		return $response;

	}


	public function create(Reques $request, Response $response):Response
	{
		$this->view('pages/admins-create.html', [
			'TITLE' => 'Cadastrar novo administrador',
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;
	}

	public function save(Reques $request)
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@60:unique@administrator'
		]);

		$admin = new Administrator();

		$admin = $admin->save($data);

		if ($admin) {
			flash('success', success("Administrador criado com sucesso"));
			redirect("/admin/users");
		}

	}


	public function edit(Reques $request, Response $response, array $args):Response
	{
		$admin = new Administrator();

		$admin = $admin->get($args['id']);

		$this->view('pages/admins-update.html', [
			'TITLE' => 'Editar Cadastrar de administrador',
			'ADMIN' => $admin,
			'COOKIE_DATA' => $_COOKIE
		]);


		return $response;
	}

}