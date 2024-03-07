<?php

namespace core;

use app\traits\Api;
use app\traits\Crud;
use app\traits\Pagination;


class Model
{
	use Api;
	use Crud;

	public function find($field, $value)
	{
		$resultFind = $this->select([$field], $this->table)->where($field, $value)->get();
		return $resultFind;
	}

}