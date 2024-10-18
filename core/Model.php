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

	public function search($field, $value)
	{
		$resultFind = $this->select($this->table)->where($field, $value)->get();
		return $resultFind;
	}


	public function findExist($field, $value, $key, $id)
	{
		$resultFind = $this->select([$field], $this->table)->where($field, $value)->where($key, '<>', $id)->get();
		return $resultFind;
	}
	

}