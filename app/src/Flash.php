<?php

namespace app\src;

class Flash
{	
	public static function add($index, $message)
	{
		if (!isset($_SESSION['variable'][$index])) {
			$_SESSION[$index] = $message;
		}
	}

	public static function get($index)
	{
		if (isset($_SESSION[$index])) {
			$message = $_SESSION[$index];
		}
		
		unset($_SESSION[$index]);

		return $message ?? NULL;
	}
}