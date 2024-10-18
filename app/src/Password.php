<?php

namespace app\src;

class Password
{
	
	public static function make(String $password)
	{
		$option = ['const => 12'];
		return password_hash($password, PASSWORD_BCRYPT, $option);
	}

	public static function verify(String $password, $hash)
	{
		return password_verify($password, $hash);
	}
	
}