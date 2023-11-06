<?php

namespace app\src;

class ValidEmail
{	
	public static function verifyEmail($email)
	{
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			throw new \Exception("O formato de e-mail informado é inválido");			
		}
	}
}