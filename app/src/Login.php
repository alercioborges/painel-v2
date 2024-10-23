<?php

namespace app\src;

use core\Model;
use app\src\Passthru;

class Login
{
	
	public function login($data, Model $model)
	{
		$user = $model->searchUser('email', $data['email']);

		if (!$user) {
			return false;
		}

		if (password::verify($data['password'], $user[0]['password']))
		{
			$_SESSION['idLoggedIn'] = $user[0]['id'];
			$_SESSION['role'] = $user[0]['role'];
			$_SESSION['loggedIn'] = true;
			return true;
		}
	}

}