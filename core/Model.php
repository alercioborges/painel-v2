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

	public function filter($fields)
	{
		$fields = explode(',', $fields);
		
	}	

}