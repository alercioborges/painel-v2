<?php

namespace app\models;

use core\Model;
use app\src\Paginate;
use app\src\Password;

class User extends Model
{

	protected $table  = 'tbl_user';

	public function getAll(int $perPage):array
	{
		$users = $this->select(
			['u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.name as role'],
			'tbl_user_role as ur'
		)
		->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')
		->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
		->orderby('id')->get();

		$paginate = Paginate::pagination($perPage, $users);
		
		return [
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		];
	}



	public function save(array $userData)
	{		
		$userData['password'] = Password::make($userData['password']);
		$userRole = ['role_id' => $userData['role_id']];

		unset($userData['role_id']);

		$userRole['user_id'] = $this->insert([$userData], $this->table);

		$roleInsertResult = $this->insert([$userRole], 'tbl_user_role');

		return [
			'user' => $userRole['user_id'],
			'role' => $roleInsertResult
		];
	}



	public function get($id)
	{
		$user = $this->select(
			['u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.id as role_id'],
			'tbl_user_role as ur'
		)
		->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')
		->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
		->where('u.id', $id)
		->get();

		if (!empty($user)) {
			return $user[0];
		}

		throw new \Exception("Usuário indefinido.");
	}


	
	public function search($field, $value)
	{
		return $this->select(
			[
				'u.id',
				'u.firstname',
				'u.lastname',
				'u.email',
				'u.password',
				'r.id as role_id',
				'r.name as role_name'
			],
			'tbl_user_role as ur'
		)	
		->innerJoin('tbl_user as u', 'u.id', '=', 'ur.user_id')
		->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
		->where("u.{$field}", $value)
		->get();
	}



	public function edit(int $id, array $userData)
	{
		$userRole = [
			'role_id' => $userData['role_id'],
			'user_id' => $id
		];

		unset($userData['role_id']);

		return [
			'user' => $this->update($this->table)->set($userData)->where('id', $id)->execute(),
			'role' => $this->update('tbl_user_role')->set($userRole)->where('user_id', $id)->execute()
		];		
	}



	public function destroy($id)
	{
		return [
			'user_role' => $this->delete('tbl_user_role')->where('user_id', $id)->execute(),
			'user' => $this->delete($this->table)->where('id', $id)->execute()
		];
	}


	public function filtered(array $fields, String $value, int $perPage):array
	{
		$users = $this->filter($fields, $value);

		$paginate = Paginate::pagination($perPage, $users);
		
		return [
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		];
	}

}