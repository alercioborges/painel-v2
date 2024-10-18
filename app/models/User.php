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
		$users = $this->select(['id', 'firstname', 'lastname', 'email'], $this->table)->get();
		
		$paginate = Paginate::pagination($perPage, $users);

		$users_data = array(
			'USERS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);

		return $users_data;
	}	

	public function save(array $adminDara)
	{		
		$adminDara['password'] = Password::make($adminDara['password']);

		$admin = $this->insert([$adminDara], $this->table);
		return $admin;
	}

	public function get($idAdmin)
	{
		$admin = $this->select(['id', 'firstname', 'lastname', 'email'], $this->table)->where('id', $idAdmin) ->get();
		return $admin[0];
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