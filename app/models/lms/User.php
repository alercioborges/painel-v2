<?php

namespace app\models\lms;

use core\Model;
use app\traits\lms\User AS traitsUser;
use app\src\Api;
use app\src\Paginate;

class User extends Model
{
	use traitsUser;

	public function getAll(int $perPage):array
	{
		$parameter = array(
			'criteria[0][key]' => 'email',
			'criteria[0][value]' => '%'
		);

		$response = Api::callApi('core_user_get_users', http_build_query($parameter));		
		
		foreach ($response['users'] as $key => $value) {
			if ($value['id'] != 1) {
				$allUsers[] = array(
					'id' => $value['id'],
					'firstname' => $value['firstname'],
					'lastname' => $value['lastname'],
					'email' => $value['email'],					
					'lastaccess' => date('d/m/Y H:i:s', $value['lastaccess']),
					'suspended' => $value['suspended']
				);
			}
		}

		$paginate = Paginate::pagination($perPage, $allUsers);

		return array(
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);

	}


	public function save(array $arg):array
	{
		$check_data = $this->verifyUserDataExists($arg['username'], $arg['email']);

		return empty($check_data) 
		? $this->verifyErrorApiSave(Api::callApi('core_user_create_users', $this->saveParameters($arg))) 
		: $check_data;
	}


	public function get(int $id):array
	{
		$parameter = '&field=id&values[0]=' . $id;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);

		return $response[0];
	}


	public function edit(array $arg):array
	{
		$parameter = $this->updateParameters($arg);
		$response = Api::callApi('core_user_update_users', $parameter);

		$return_api = $this->verifyErrorApiUpdate($response);
		
		return $return_api;
	}
	


	public function redefinePassword(int $id):bool
	{
		$user_data = $this->get($id);

		$parameter = '&username=' . $user_data['username'];
		$response = Api::callApi('core_auth_request_password_reset', $parameter);

		if (isset($response['status']) && $response['status'] == 'emailpasswordconfirmmaybesent') {
			return true;
		} else { return false; }
	}


	private function verifyUserDataExists(String $username, String $email):array
	{		
		$return_api = [];

		$parameter = '&field=email&values[0]=' . $email;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);

		if ($response != NULL) {
			$return_api = array(
				'message' => "Este e-mail já existe",
				'success' => false,
				'field' => 'email'
			);
		}

		$parameter = '&field=username&values[0]=' . $username;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);		

		if ($response != NULL) {
			$return_api = array(
				'message' => "Este nome de usuário já existe",
				'success' => false,
				'field' => 'username'
			);
		}

		return $return_api;

	}


	private function verifyErrorApiSave(array $response):array
	{
		if (isset($response[0]['username']) && $response[0]['username'] == strtolower($_POST['username'])) {
			$return_api = array(
				'message' => "Usuário cadastrado com sucesso!",
				'success' => true
			);
		}

		elseif (array_key_exists('message', $response) && str_contains($response['message'], 'error/')) {
			$return_api = array(
				'message' => $response['errorcode'],
				'success' => false,
				'field' => 'password'
			);
		}

		return $return_api;
	}

	private function verifyErrorApiUpdate(array $response):array
	{
		if(isset($response['warnings'][0])){
			if(array_key_exists('warningcode', $response['warnings'][0]) && str_contains($response['warnings'][0]['warningcode'], 'dmlwriteexception')) {
				$return_api = array(
					'message' => "Nome de usuário já existe",
					'success' => false,
					'field' => 'username'
				);
			}
			elseif (array_key_exists('warningcode', $response['warnings'][0]) && str_contains($response['warnings'][0]['warningcode'], 'useremailduplicate')) {
				$return_api = array(
					'message' => "E-mail já existe",
					'success' => false,
					'field' => 'email'
				);
			}
		} elseif ($response['warnings'] == NULL) {
			$return_api = array(
				'message' => "Usuário atualizado com sucesso!",
				'success' => true
			);
		}

		return $return_api;
	}
}