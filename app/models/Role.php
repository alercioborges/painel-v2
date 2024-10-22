<?php

namespace app\models;

use core\Model;

class Role extends Model
{
	protected $table  = 'tbl_role';

	public function getRoles()
	{
		$roles = $this->select(['id', 'name'], $this->table)->orderby('name')->get();
		return $roles;
	}

}