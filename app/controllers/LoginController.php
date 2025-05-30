<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;
use app\src\Validate;
use app\src\Login;
use app\models\User;

class LoginController extends Controller
{

	public function index(Reques $request, Response $response): Response
	{
		$this->view('pages/login.html', [
			'TITLE' => 'Acessar',
			'COOKIE_EMAIL' => $_SESSION['email'] ?? NULL
		]);

		return $response;
	}

	public function login()
	{
		try {
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

			// Remove email da sessão em caso de sucesso
			unset($_SESSION['email']);

			$redirec = $_SESSION['redirect'] ?? '/';
			unset($_SESSION['redirect']);
			redirect($redirec);
		} catch (\Exception $e) {
			// Log do erro (assumindo que existe um sistema de log)
			error_log('Login error: ' . $e->getMessage());
			flash('error', error('Erro interno. Tente novamente.'));
			redirect('/login');
		}
	}

	public function logout()
	{
		try {
			$login = new Login();
			$login->logout();

			redirect('/login');

		} catch (\Exception $e) {
			error_log('Logout error: ' . $e->getMessage());
			flash('error', error('Erro ao realizar logout'));
			redirect('/');
		}
	}
}
