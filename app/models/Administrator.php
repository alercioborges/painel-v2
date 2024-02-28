<?php

namespace app\models;

use core\Model;

class Administrator extends Model
{
	public function getAll()
	{
		$admins = $this->select(
			['firstname',
			'lastname',
			'email'],
			'tbl_adminstrator')->get();

		return $admins;
	}

	public function save($adminDara)
	{
		dd($adminDara);
	}


}