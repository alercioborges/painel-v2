<?php

namespace app\models;

class Paginate{

	private $page;
	private $perPage;
	private $offset;
	private $pages;
	private $records;

	private function current()
	{
		$this->page = $_GET['page'] ?? 1;
	}

	private function perPage($perPage)
	{
		$this->perPage = $perPage ?? 30;
	}

	private function offset()
	{
		$this->offset = ($this->page * $this->perPage) - $this->perPage;
	}

	public function records($records)
	{
		$this->records = $records;
		return $this->records;
	}

	private function pages()
	{
		$this->pages = ceil($this->records / $this->perPage);
	}

	public function sqlPaginate()
	{
		return "->limit({$this->offset}, {$this->perPage})";
	}

	public function paginate($perPage)
	{
		$this->current();
		$this->perPage($perPage);
		$this->offset();
	}
}