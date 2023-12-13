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

		$return_api = $this->verifyErrorApiSave($response);

		return $return_api;	
	}



	public function get(int $id):array
	{
		$parameter = '&field=id&values[0]=' . $id;

		$response = $this->callApi('core_user_get_users_by_field', $parameter);
		
		$return_api = array(
			'id' => $response[0]['id'],
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

		$response = $this->callApi('core_user_update_users', $parameter);

		$return_api = $this->verifyErrorApiUpdate($response);

		return $return_api;
	}


	private function verifyErrorApiSave(array $response):array
	{
		if (isset($response[0]['username']) && $response[0]['username'] == strtolower($_POST['username'])) {
			$return_api = array('message' => "Usuário cadastrado com sucesso!", 'cod' => 0);
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

	private function verifyErrorApiUpdate(array $response):array
	{
		if(isset($response['warnings'][0])){
			if(array_key_exists('message', $response['warnings'][0]) && str_contains($response['warnings'][0]['message'], 'Duplicate entry')) {
				$return_api = array('message' => "Nome de usuário já existe", 'cod' => 2);
			}
			elseif (array_key_exists('message', $response['warnings'][0]) && str_contains($response['warnings'][0]['message'], 'Duplicate email address')) {
				$return_api = array('message' => "E-mail já existe", 'cod' => 1);
			}
		}
		elseif ($response[0] == NULL) {
			$return_api = array('message' => "Usuário atualizado com sucesso!", 'cod' => 0);
		}
		else{
			$return_api = array_values($response);
		}

		return $return_api;
	}
}