<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

class LoginController extends Controller
{
	
	public function index(Reques $request, Response $response):Response
	{
		$this->view('pages/login.html', [
			'TITLE' => 'Acessar',
			'COOKIE_DATA' => $_COOKIE
		]);

		return $response;

	}

	public function login(Reques $request, Response $response):Response
	{		
		
		redirect('/');

		return $response;
	}

}