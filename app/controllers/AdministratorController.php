<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\Administrator;

class AdministratorController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$admins = new Administrator();

		$allAdmins = $admins->getAll();

		dd($allAdmins);
		
		$this->view('pages/teste.html', [
			'TITLE' => 'Teste'
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

}