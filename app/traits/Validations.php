<?php

namespace app\traits;

trait Validations{

	private $errors = [];

	protected function required($field)
	{
		if (empty($_POST[$field])) {
			$this->errors[$field][] = flash($field, error("Compo obrigatório"));
		}
	}

	protected function email($field)
	{

	}

	protected function unique($field)
	{
		
	}

	public function hasErrors()
	{
		return !empty($this->errors);
	}

}