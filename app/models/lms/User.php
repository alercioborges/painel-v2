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
		
		if (isset($response['users']) && is_array($response['users'])) {
			foreach ($response['users'] as $user) {
				if ($user['id'] != 1) {
					$allUsers[] = [
						'id' => $user['id'],
						'firstname' => $user['firstname'],
						'lastname' => $user['lastname'],
						'email' => $user['email'],
						'lastaccess' => $user['lastaccess'] ? date('d/m/Y H:i:s', $user['lastaccess']) : 'Never',
						'suspended' => $user['suspended']
					];
				}
			}
		}

		$paginate = Paginate::pagination($perPage, $allUsers);

		return [
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		];

	}


	public function save(array $arg):array
	{
		$checkUser = $this->verifyUserDataExists($arg['username'], $arg['email']);

		if (!empty($checkUser)) {
			return $checkUser;
		}

		$response = Api::callApi('core_user_create_users', $this->saveParameters($arg));
		return $this->verifyErrorApiSave($response);
	}


	public function get(int $id):array
	{
		$parameter = '&field=id&values[0]=' . $id;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);

		return $response[0] ?? [];
	}


	public function edit(array $arg):array
	{
		$parameter = $this->updateParameters($arg);
		$response = Api::callApi('core_user_update_users', $parameter);
		
		return $this->verifyErrorApiUpdate($response);		

	}
	


	public function redefinePassword(int $id):bool
	{
		$user_data = $this->get($id);

		$parameter = '&username=' . $user_data['username'];
		$response = Api::callApi('core_auth_request_password_reset', $parameter);

		return (isset($response['status']) && $response['status'] == 'emailpasswordconfirmmaybesent') ? true : false;
	}


	private function verifyUserDataExists(String $username, String $email):array
	{
		$parameter = '&field=username&values[0]=' . $username;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);		

		if (!empty($response)) {
			return [
				'message' => "Este nome de usuário já existe",
				'success' => false,
				'field' => 'username'
			];
		}

		$parameter = '&field=email&values[0]=' . $email;
		$response = Api::callApi('core_user_get_users_by_field', $parameter);

		if (!empty($response)) {
			return [
				'message' => "Este e-mail já existe",
				'success' => false,
				'field' => 'email'
			];
		}

		return [];

	}


	private function verifyErrorApiSave(array $response):array
	{
		if (isset($response[0]['username']) && $response[0]['username'] == strtolower($_POST['username'])) {
			return [
				'message' => "Usuário cadastrado com sucesso!",
				'success' => true
			];
		}

		elseif (array_key_exists('message', $response) && str_contains($response['message'], 'error/')) {
			return [
				'message' => $response['errorcode'],
				'success' => false,
				'field' => 'password'
			];
		}

		return [];
	}


	private function verifyErrorApiUpdate(array $response):array
	{
		if(isset($response['warnings'][0])) {

			$warning = $response['warnings'][0];

			if (str_contains($warning['warningcode'] ?? '', 'dmlwriteexception')) {
				return [
					'message' => "Nome de usuário já existe",
					'success' => false,
					'field' => 'username'
				];
			}

			if (str_contains($warning['warningcode'] ?? '', 'useremailduplicate')) {
				return [
					'message' => "E-mail já existe",
					'success' => false,
					'field' => 'email'
				];
			}
		}

		return [
			'message' => 'Usuário atualizado com sucesso!',
			'success' => true
		];
	}

}