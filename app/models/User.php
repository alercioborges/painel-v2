<?php

namespace app\models;

use core\Model;

class User extends Model
{

	public function getAll(int $page, int $perPage):array
	{
		$admins = $this->select(['value'], 'mdl_config')
		->where('name', '=', 'siteadmins')
		->get();

		$user_admins = $admins[0]['value'];

		if (str_contains($user_admins, ',')) {
			$user_admins = explode(',', $user_admins);
		} else {
			$user_admins = array($user_admins);
		}

		$records = count($this->select(['id'], 'mdl_user')
		->where('deleted', '=', '0')
		->get());

		$pages = ceil($records / $perPage);		

		$users = $this->select(['id', 'firstname', 'lastname', 'email', 'suspended'], 'mdl_user')
		->where('deleted', '=', '0')->limit($page, $perPage)
		->get();		

		foreach ($users as $key => $value) {
			if (array_intersect($user_admins, $users[$key])) {
				$users[$key] += ['is_admin' => true];
			} else {
				$users[$key] += ['is_admin' => false];
			}
		}

		$user_data = array(
			'users' => $users, 
			"pages" => $pages
		);

		return $user_data;
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

		return $response[0];
	}


	public function edit(array $arg)
	{
		$parameter = $this->updateParameters($arg);

		$response = $this->callApi('core_user_update_users', $parameter);

		$return_api = $this->verifyErrorApiUpdate($response);

		return $return_api;
	}


	public function destroy(int $id):array
	{
		$parameter = '&userids[0]=' . $id;

		$response = $this->callApi('core_user_delete_users', $parameter);

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

		$response = $this->callApi('core_auth_request_password_reset', $parameter);

		if (isset($response['status']) && $response['status'] == 'emailpasswordconfirmmaybesent') {
			flash('success', success('E-mail de redefinição de senha enviado com sucesso!'));
			redirect("/users/{$id}/profile");
		}

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
		elseif (in_array("Email address already exists: {$_POST['email']}", $response)) {
			$return_api = array(
				'message' => "Este email já existe",
				'success' => false,
				'field' => 'email'
			);
		}
		elseif (in_array("Username already exists: {$_POST['username']}", $response)) {
			$return_api = array(
				'message' => "Este nome de usuário já existe",
				'success' => false,
				'field' => 'username'
			);
		}
		elseif (isset($response['message']) && str_contains($response['message'], 'error/')) {
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
			if(array_key_exists('message', $response['warnings'][0]) && str_contains($response['warnings'][0]['message'], 'Duplicate entry')) {
				$return_api = array(
					'message' => "Nome de usuário já existe",
					'success' => false,
					'field' => 'username'
				);
			}
			elseif (array_key_exists('message', $response['warnings'][0]) && str_contains($response['warnings'][0]['message'], 'Duplicate email address')) {
				$return_api = array(
					'message' => "E-mail já existe",
					'success' => false,
					'field' => 'email'
				);
			}
		}
		elseif ($response[0] == NULL) {
			$return_api = array(
				'message' => "Usuário atualizado com sucesso!",
				'success' => true
			);
		}

		return $return_api;
	}
}