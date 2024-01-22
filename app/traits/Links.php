<?php

namespace app\traits;

trait Links{

	protected $maxLinks = 4;

	private function previous()
	{
		if ($this->pages() > 1) {
			$preview = ($this->page[$this->current - 1]);

			$links = '<li><a href="?page=1"> [1] </a></li>';
			$links .= '<li><a href="?page=' . $preview . '" arial-label="Previous"> <span arial-hidden="true">&laquo;</span></a></li>';

			return $links;
		}
	}


	private function next()
	{
		if ($this->page() < $this->pages()) {
			$next = ($this->page[$this->current + 1]);

			$links = '<li><a href="?page=1">' . $next . '" arial-label="Next"> <span arial-hidden="true">&raquo;</span></a></li>';
			$links .= '<li><a href="?page=' . $this->pages() . '"> [' .$this->pages(). ']</a></li>';

			return $links;
		}
	}




}