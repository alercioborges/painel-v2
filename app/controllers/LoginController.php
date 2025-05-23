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
			'COOKIE_EMAIL' => $_SESSION['email'] ?? NULL
		]);

		return $response;

	}

	public function login()
	{
		$validate = new Validate();

		$data = $validate->validate([
			'email'		=> 'email:required'
		]);

		$login = new Login();

		$loggedIn = $login->login($data, new User);

		if (!$loggedIn) {
			$_SESSION['email'] = $data['email'];
			flash('error', error("Nome de usuário e/ou senha incorreto"));
			redirect('/login');	
		}
	 	
		
		$redirec = $_SESSION['redirect'] ?? '/';
		unset($_SESSION['redirect']);
		redirect($redirec);
				
	}

	public function logout()
	{
		$login = new Login();
		$login->logout();

		redirect('/login');
	}

}