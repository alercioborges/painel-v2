<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\src\Validate;
use app\src\Login;
Use app\models\User;

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
		$validate = new Validate();

		$data = $validate->validate([
			'email'		=> 'email:required',
			'password' => 'required'
		]);

		$login = new Login();

		$loggedIn = $login->login($data, new User);
		dd($_SESSION);
		return $response;
	}

}