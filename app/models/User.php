<?php

namespace app\models;

use core\Model;

class User extends Model
{
	public function getAll():array
	{
		$response = $this->callApi('core_user_get_users', 'criteria[0][key]=suspended&criteria[0][value]=false');

		return $response['users'];
	}

	public function save(array $arg)
	{
		$parameter = $this->saveParameters($arg);

		$response = $this->callApi('core_user_create_users', $parameter);

		return $response;		
	}

}

