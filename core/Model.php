<?php

namespace core;

use app\traits\Crud;
use app\traits\Pagination;


class Model
{
	use Crud;

	public function find($field, $value)
	{
		return $this->select([$field], $this->table)->where($field, $value)->get();
	}


	public function findExist($field, $value, $key, $id)
	{
		return $this->select([$field], $this->table)->where($field, $value)->where($key, '<>', $id)->get();
	}


	public function filter(array $fields, String $value):array
	{
		$query = $this->select($fields, $this->table);

		foreach ($fields as $field) {
			$query->orWhere($field, 'like', '%'.search($value).'%');
		}

		return $query->get();
	}	

}