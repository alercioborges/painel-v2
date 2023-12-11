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

		if (isset($response[0]['username']) && $response[0]['username'] == strtolower($_POST['username'])) {
			$return_api = array('message' => "Deu certo", 'cod' => 0);
		}
		elseif (in_array("Email address already exists: {$_POST['email']}", $response)) {
			$return_api = array('message' => "Este email já existe", 'cod' => 1);
		}
		elseif (in_array("Username already exists: {$_POST['username']}", $response)) {
			$return_api = array('message' => "Este nome de usuário já existe", 'cod' => 2);
		}
		elseif (isset($response['message']) && str_contains($response['message'], 'error/')) {
			$return_api = array('message' => $response['errorcode'], 'cod' => 3);
		}		
		else {
			$return_api = array_values($response);
		}

		return $return_api;	
	}

}

