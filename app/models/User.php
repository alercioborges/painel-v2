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

	public function save(array $arg):array
	{
		$parameter = $this->saveParameters($arg);

		$response = $this->callApi('core_user_create_users', $parameter);

		$return_api = $this->verifyErrorApi($response);

		return $return_api;	
	}



	public function get(int $id):array
	{
		$parameter = '&field=id&values[0]=' . $id;

		$response = $this->callApi('core_user_get_users_by_field', $parameter);
		
		$return_api = array(
			'username' => $response[0]['username'],
			'firstname' => $response[0]['firstname'],
			'lastname' => $response[0]['lastname'],
			'email' => $response[0]['email']
		);

		return $return_api;
	}


	public function update(array $arg)
	{
		$parameter = $this->updateParameters($arg);

		$response = $this->callApi('', $parameter);

		$return_api = $this->verifyErrorApi($response);

		return $return_api;
	}	
}

