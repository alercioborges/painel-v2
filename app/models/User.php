<?php

namespace app\models;

use core\Model;
use app\src\Paginate;
use app\src\Password;

class User extends Model
{

	protected $table  = 'tbl_user';

	public function getAll(int $perPage)
	{
		$users = $this->select([
			'u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.name as role'], 'tbl_user_role as ur')->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')->orderby('id')->get();

		$paginate = Paginate::pagination($perPage, $users);
		
		return array(
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);
	}



	public function save(array $userDataa)
	{		
		$userDataa['password'] = Password::make($userDataa['password']);
		$user_role['role_id'] = $userDataa['role_id'];

		unset($userDataa['role_id']);

		$user_role['user_id'] = $this->insert([$userDataa], $this->table);

		$result['user'] = $user_role['user_id'];

		$result['role'] = $this->insert([$user_role], 'tbl_user_role');
		
		return $result;
	}



	public function get($id)
	{
		$user = $this->select([
			'u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.id as role_id'
		], 'tbl_user_role as ur')->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')->where('u.id', $id)->get();
		
		if (isset($user[0])) {
			return $user[0];
		} else {
			throw new \Exception("Usuário indefinido");			
		}		
	}


	
	public function search($field, $value)
	{
		return $this->select([
			'u.id',
			'u.firstname',
			'u.lastname',
			'u.email',
			'u.password',
			'r.id as role_id',
			'r.name as role_name'],
			'tbl_user_role as ur')
		->innerJoin('tbl_user as u', 'u.id', '=', 'ur.user_id')
		->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
		->where("u.{$field}", $value)
		->get();
	}



	public function edit(int $id, array $userData)
	{
		$user_role['role_id'] = $userData['role_id'];
		$user_role['user_id'] = $id;

		unset($userData['role_id']);		

		$result['user'] = $this->update($this->table)->set($userData)->where('id', $id)->execute();
		$result['role'] = $this->update('tbl_user_role')->set($user_role)->where('user_id', $id)->execute();

		return $result;		
	}



	public function destroy($id)
	{
		$result['user_role'] = $this->delete('tbl_user_role')->where('user_id', $id)->execute();
		$result['user'] = $this->delete($this->table)->where('id', $id)->execute();

		return $result;
	}

}