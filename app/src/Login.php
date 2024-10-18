<?php

namespace app\src;

use core\Model;
use app\src\Passthru;
use app\src\Load;

class Login
{
	
	public function login($data, Model $model)
	{		
		$config = Load::file('/app/Authorization.php')['admin'];

		$user = $model->search('email', $data['email']);

		if (!$user) {
			return false;
		}

		if (password::verify($data['password'], $user[0]['password']))
		{
			$_SESSION[$config['idLoggedIn']] = $user[0]['id'];
			$_SESSION[$config['loggedIn']] = true;
			return true;
		}
	}

}