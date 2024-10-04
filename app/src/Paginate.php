<?php

namespace app\src;

use app\traits\Crud;

class Paginate
{
	public static function pagination(int $perPage, array $data)
	{
		$recods = count($data);
		$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
		$offset = ($page - 1) * $perPage;
		$pages = ceil($recods / $perPage);

		$dataInPage = array_slice($data, $offset, $perPage);

		$paginate_data = array(
			'dataInPage' => $dataInPage,
			'pages' => $pages
		);

		return $paginate_data;
	}
}