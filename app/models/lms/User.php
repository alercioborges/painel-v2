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

		$users_data = array(
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);

		return $users_data;

	}


	public function save(array $arg):array
	{
		$check_data = $this->verifyUserDataExists($arg['username'], $arg['email']);

		if ($check_data == NULL){

			$parameter = $this->saveParameters($arg);

			$response = Api::callApi('core_user_create_users', $parameter);

			$return_api = $this->verifyErrorApiSave($response);

			return $return_api;

		} else {

			return $check_data;
		} 
	}


	public function get(int $id):array
	{
		$parameter = '&field=id&values[0]=' . $id;

		$response = Api::callApi('core_user_get_users_by_field', $parameter);

		return $response[0];
	}


	public function edit(array $arg)
	{
		$parameter = $this->updateParameters($arg);

		$response = Api::callApi('core_user_update_users', $parameter);

		$return_api = $this->verifyErrorApiUpdate($response);

		return $return_api;
	}


	public function destroy(int $id):array
	{
		$parameter = '&userids[0]=' . $id;

		$response = Api::callApi('core_user_delete_users', $parameter);

		$return_api = [];

		if (empty($response)) {
			$return_api = array(
				'message' => "Usuário excluído com sucesso!",
				'success' => true
			);
		}

		return $return_api;
	}


	public function suspend(int $id):array
	{
		$user_suspend = $this->update('mdl_user')
		->set('suspended', 1)
		->where('id', $id)
		->execute();

		$return_suspend = [];

		if ($user_suspend) {
			$return_suspend = array(
				'message' => "Conta de usuário suspensa!",
				'success' => true
			);
		}

		return $return_suspend;
	}

	public function unsuspend(int $id):array
	{
		$user_unsuspend = $this->update('mdl_user')
		->set('suspended', 0)
		->where('id', $id)
		->execute();

		$return_unsuspend = [];

		if ($user_unsuspend) {
			$return_unsuspend = array(
				'message' => "Conta de usuário ativada!",
				'success' => true
			);
		}

		return $return_unsuspend;
	}


	public function redefinePassword(int $id):void
	{
		$user_data = $this->get($id);

		$parameter = '&username=' . $user_data['username'];

		$response = Api::callApi('core_auth_request_password_reset', $parameter);

		if (isset($response['status']) && $response['status'] == 'emailpasswordconfirmmaybesent') {
			flash('success', success('E-mail de redefinição de senha enviado com sucesso!'));
			redirect("/lms/users/{$id}/profile");
		}
	}


	private function verifyUserDataExists(String $username, String $email)
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
		$return_api = [];

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
		$return_api = [];

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
		}
		elseif ($response['warnings'] == NULL) {
			$return_api = array(
				'message' => "Usuário atualizado com sucesso!",
				'success' => true
			);
		}

		return $return_api;
	}
}