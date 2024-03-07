<?php

namespace app\models;

use core\Model;

class Administrator extends Model
{

	protected $table  = 'tbl_adminstrator';

	public function getAll()
	{
		$admins = $this->select(
			['firstname',
			'lastname',
			'email'],
			$this->table)->get();

		return $admins;
	}

	public function save($adminDara)
	{
		$admin = $this->insert([$adminDara], $this->table);

		if ($admin) {
			echo "successo";
		}
	}


}