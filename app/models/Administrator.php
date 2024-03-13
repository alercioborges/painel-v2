<?php

namespace app\models;

use core\Model;
use app\src\Paginate;

class Administrator extends Model
{

	protected $table  = 'tbl_adminstrator';

	public function getAll(int $perPage)
	{
		$allAdmins = $this->select(['id', 'firstname', 'lastname', 'email'], $this->table);

		$paginate = Paginate::pagination($perPage, $allAdmins);

		$admins_data = array(
			'ADMINS' => $paginate['dataInPage'],
			'PAGES' => $paginate['pages']
		);

		return $admins_data;
	}

	public function save($adminDara)
	{
		$admin = $this->insert([$adminDara], $this->table);
		return $admin;
	}

	public function get($idAdmin)
	{
		$admin = $this->select(['firstname', 'lastname', 'email'], $this->table)->where('id', $idAdmin) ->get();
		return $admin[0];
	}



}