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

		$admins = $admin->getAll();

		dd($admins);

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

	public function save(Reques $request, Response $response):Response
	{
		$validate = new Validate();

		$data = $validate->validate([			
			'firstname'	=> 'required:max@30',
			'lastname'	=> 'required:max@30',
			'email'		=> 'email:required:max@60:unique@administrator',
			'password'	=> 'required:max@30'
		]);

		$admin = new Administrator();

		$admin = $admin->save($data);

		return $response;
	}
}