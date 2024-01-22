<?php

namespace app\traits;

use app\src\Paginate;

trait Pagination{

	protected function paginate($perPage, $list)
	{
		$paginate = new Paginate();

		$paginate->records($list);

		$paginate->paginate($perPage);

		return $this;
	}

}