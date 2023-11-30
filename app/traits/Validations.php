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
		if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
			$this->errors[$field][] = flash($field, error("O e-mail inserido é inválido"));
		}
	}

	protected function unique($field)
	{
		
	}
	

	public function hasErrors(array $formData = [])
	{
		return !empty($this->errors);
	}

}