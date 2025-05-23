<?php

namespace app\src;

use app\models\User;
use app\src\Passthru;

class Login
{
	
	public function login(array $data, User $model):bool
	{
		$user = $model->search('email', $data['email']);

		if (!$user) {
			return false;
		}

		return password_verify($data['password'], $user[0]['password']) ?
			($_SESSION['idLoggedIn'] = $user[0]['id']) && 
			($_SESSION['idRole'] = $user[0]['role_id']) && 
			($_SESSION['loggedIn'] = true) && true 
		: false;
	}


	public function logout()
	{	
		session_unset();
		session_destroy();
	}

}