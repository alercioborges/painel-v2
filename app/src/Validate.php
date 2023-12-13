<?php

namespace app\src;

use app\traits\Validations;
use app\traits\Sanitize;

class Validate
{
	use Validations, Sanitize;

	public function validateApi(array $return_api)
	{
		if(array_key_exists('cod', $return_api) && $return_api['cod'] == 2){
			$this->errors['username'][] = flash('username', error($return_api['message']));	
		}
		elseif(array_key_exists('cod', $return_api) && $return_api['cod'] == 1){
			$this->errors['email'][] = flash('email', error($return_api['message']));	
		}
		elseif(array_key_exists('cod', $return_api) && $return_api['cod'] ==  3) {
			$this->errors['password'][] = flash('password', error($return_api['message']));	
		}		

		$this->checkError();

		if(array_key_exists('cod', $return_api) && $return_api['cod'] ==  0) {
			flash('success', success($return_api['message']));
			redirect("/users");
		}
	}

	public function validate($rules)
	{
		foreach ($rules as $field => $validation) {

			$validation = $this->validateWithParameter($field, $validation);

			if ($this->hasOneValidation($validation)) {
				$this->$validation($field);							
			}

			if ($this->hasTwoOrMoreValidation($validation)) {
				$validations = explode(':', $validation);

				foreach ($validations as $validation) {
					$this->$validation($field);
				}
			}
		}

		$this->checkError();

		return $this->sanitize();

	}


	private function validateWithParameter($field, $validation)
	{		
		$validations = [];

		if (substr_count($validation, '@' ) > 0) {
			$validations = explode(':', $validation);
		}

		foreach ($validations as $key => $value) {
			if (substr_count($value, '@' ) > 0) {
				list($validationWithParameter, $parameter) = explode('@', $value);

				$this->$validationWithParameter($field, $parameter);

				unset($validations[$key]);

				$validation = implode(':', $validations);
			}
		}

		return $validation;
	}


	private function hasOneValidation($validate)
	{
		return substr_count($validate, ':') == 0;
	}


	private function hasTwoOrMoreValidation($validate)
	{
		return substr_count($validate, ':') >= 1;
	}

	private function checkError()
	{
		if ($this->hasErrors()) {
			setCookieForm($_POST);
			back();
		}
	}

}