<?php

namespace app\src;

use app\traits\Links;

class Paginate
{

	use Links;

	private $perPage;
	private $list;

	public function __construct(int $perPage, array $list)
	{
		$this->perPage = $perPage;
		$this->list = $list;
	}

	public function current()
	{
		$current = isset($_GET['page']) ? intval($_GET['page']) : 1;
		return $current;
	}

	public function page()
	{
		$page = array_chunk($this->list, $this->perPage);
		return $page;
	}

	public function pages()
	{
		$pages = count($page);
		return $pages;
	}	

}

