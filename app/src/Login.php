<?php

namespace app\src;

use app\models\Model;

class Login
{
	
	public function login($data, Modle $model)
	{
		$user = 'select email where email = $data->email';

		if (!$user) {
			return false;
		}

		if (Passthru::verift($dara->password, $user->password))
		{
			
		}
	}
	
}