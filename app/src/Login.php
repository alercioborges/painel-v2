<?php

namespace app\src;

use core\Model;
use app\src\Passthru;

class Login
{
	
	public function login(array $data, Model $model):bool
	{
		$user = $model->searchUser('email', $data['email']);

		if (!$user) {
			return false;
		}

		if (password::verify($data['password'], $user[0]['password']))
		{
			$_SESSION['idLoggedIn'] = $user[0]['id'];
			$_SESSION['idRole'] 	= $user[0]['role_id'];
			$_SESSION['loggedIn'] 	= true;
			return true;
		} else { return false; }
	}

	public function logout()
	{
		session_destroy();
	}

}