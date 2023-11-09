<?php

namespace app\src;

class Flash
{	
	public static function add($index, $message)
	{
		if (!isset($_SERVER[$index])) {
			$_SERVER[$index];
		}
	}

	public static function get($index)
	{
		if (isset($_SERVER[$index])) {
			$message = $_SERVER[$index];
		}

		unset($_SERVER[$index]);

		return $message ?? NULL;
	}
}