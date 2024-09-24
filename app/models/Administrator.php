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

	public function save(array $adminDara)
	{
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