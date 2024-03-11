<?php

namespace app\src;

use app\traits\Crud;

class Paginate
{
	public static function pagination(int $perPage, Object $data)
	{
		$recods = count($data->get());
		$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
		$offset = ($page - 1) * $perPage;
		$pages = ceil($recods / $perPage);

		$dataInPage = $data->limit($perPage)
		->offset($offset)
		->get();

		$paginate_data = array(
			'dataInPage' => $dataInPage,
			'pages' => $pages
		);

		return $paginate_data;
	}
}