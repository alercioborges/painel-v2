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

		if (array_key_exists(0, $response) && $response[0]['username'] == $_POST['username']) {
			$return_api = array('message' => "Deu certo", 'cod' => 0);
		}
		elseif (in_array("Email address already exists: {$_POST['email']}", $response)) {
			$return_api = array('message' => "Este email já existe", 'cod' => 1);
		}
		elseif (in_array("Username already exists: {$_POST['username']}", $response)) {
			$return_api = array('message' => "Este nome de usuário já existe", 'cod' => 2);
		}
		else {
			$return_api = array('message' => $response['errorcode'], 'cod' => 3);
		}

		return $return_api;		
	}

}

