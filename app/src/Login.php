<?php

namespace app\src;

use app\models\Model;
use app\src\Passthru;
use app\src\Load;

class Login
{
	
	public function login($data, Modle $model)
	{		
		$config = Load::file('/Autorization.php')['admin'];

		$role = $model->select(['email'], $model->table)->where('email', $dat['email']);

		if (!$user) {
			return false;
		}

		if (Passthru::verift($dara['password'], $user->password))
		{
			$_SESSION[$config['idLoggedIn']] = $user->id;
			$_SESSION[$config['loggedIn']] = true;
			return true;
		}
	}

}