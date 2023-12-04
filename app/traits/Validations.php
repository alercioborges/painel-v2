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

	protected function username($field)
	{
		if(preg_match('/[^a-z0-9\.@_-]/', $_POST[$field])) {
			$this->errors[$field][] = flash($field, error('O nome de usuário pode conter apenas caracteres minúsculos alfanuméricos (letras e números), sublinhado (_), hífen (-), ponto (.) ou símbolo arroba (@).'));
		}
	}



	protected function max($field, $max)
	{
		if (strlen($_POST[$field]) > $max) {
			$this->errors[$field][] = flash($field, error("O número de caracteres para este campo não pode ser maior que {$max}"));
		}
	}
	

	public function hasErrors(array $formData = [])
	{
		return !empty($this->errors);
	}

}