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
			'u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.name as role'], 'tbl_user_role as ur')->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')->get();

		$paginate = Paginate::pagination($perPage, $users);
		
		$users_data = array(
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);

		return $users_data;
	}	

	public function save(array $userDataa)
	{		
		$userDataa['password'] = Password::make($userDataa['password']);
		$user_role['role_id'] = $userDataa['role_id'];

		unset($userDataa['role_id']);

		$user_role['user_id'] = $this->insert([$userDataa], $this->table);
		$this->insert([$user_role], 'tbl_user_role');
		
		return $user_role['user_id'];
	}

	public function get($user_id)
	{
		$user = $this->select([
			'u.id', 'u.firstname', 'u.lastname', 'u.email', 'r.id as role_id'], 'tbl_user_role as ur')->innerJoin("$this->table as u", 'u.id', '=', 'ur.user_id')->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')->where('u.id', $user_id)->get();
		
		return $user[0];
	}

	public function edit(int $id, array $data)
	{
		$admin = $this->update($this->table)->set($data)->where('id', $id)->execute();
		return $admin;		
	}

	public function destroy($id)
	{
		$deleted = $this->delete($this->table)->where('id', $id)->execute();
		return $deleted;
	}

}