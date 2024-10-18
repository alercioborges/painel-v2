<?php

namespace app\models;

use app\models\User;

class Role extends User{

	protected $table  = 'tbl_role';

	public function getRoles()
	{
		$roles = $this->select(['name'], $this->table)->get();
		return $roles;
	}

}