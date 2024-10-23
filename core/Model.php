<?php

namespace core;

use app\traits\Crud;
use app\traits\Pagination;


class Model
{
	use Crud;

	public function find($field, $value)
	{
		$resultFind = $this->select([$field], $this->table)->where($field, $value)->get();
		return $resultFind;
	}

	public function searchUser($field, $value)
	{
		$result = $this->select([
			'u.id',
			'u.firstname',
			'u.lastname',
			'u.email',
			'u.password',
			'r.name as role'],
			'tbl_user_role as ur')
		->innerJoin('tbl_user as u', 'u.id', '=', 'ur.user_id')
		->innerJoin('tbl_role as r', 'r.id', '=', 'ur.role_id')
		->where("u.{$field}", $value)
		->get();

		return $result;
	}


	public function findExist($field, $value, $key, $id)
	{
		$resultFind = $this->select([$field], $this->table)->where($field, $value)->where($key, '<>', $id)->get();
		return $resultFind;
	}

}