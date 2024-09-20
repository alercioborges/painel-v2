<?php

namespace app\src;

use app\models\Model;
use app\src\Passthru;

class Login
{
	
	public function login($data, Modle $model)
	{
		$user = $model->select(['email'], $model->table)->where('email', $dat['email']);

		if (!$user) {
			return false;
		}

		if (Passthru::verift($dara->password, $user->password))
		{
			
		}
	}
	
}