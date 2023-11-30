<?php

namespace app\src;

use app\traits\Validations;

class Validate
{
	use Validations;

	function __construct(array $return_api)
	{
		if($return_api['cod'] == 2){
			$this->errors['username'][] = flash('username', error($return_api['message']));	
		}
		elseif($return_api['cod'] == 1){
			$this->errors['email'][] = flash('email', error($return_api['message']));	
		}
		elseif($return_api['cod'] == 3){
			$this->errors['password'][] = flash('password', error($return_api['message']));	
		}
	}

	public function validate($rules)
	{
		foreach ($rules as $field => $validation) {
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

		if ($this->hasErrors()) {
			setCookieForm($_POST);
			back();
		}

	}

	public function hasOneValidation($validate)
	{
		return substr_count($validate, ':') == 0;
	}


	private function hasTwoOrMoreValidation($validate)
	{
		return substr_count($validate, ':') >= 1;
	}

}