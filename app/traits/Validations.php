<?php

namespace app\traits;

traits Validations{

	private $errors = [];

	protected function requied($field)
	{
		if (empty($_POST[$index])) {
			$this->errors[$field][] = flash($field, error("Compo obrigatório"));;
		}
	}

	protected function email($field)
	{

	}

	protected function unique($field)
	{
		
	}

}