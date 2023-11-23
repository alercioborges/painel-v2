<?php

namespace app\src;

class Redirect
{
	public static function redirect($target)
	{
		return header("Location: {$target}");
	}


	public static function back()
	{
		$previus = "javascript:history.go(-1)";

		if(isset($_SERVER['HTTP_REFERER'])) {
			$previus = $_SERVER['HTTP_REFERER'];
		}

		return header("Location: {$previus}");
	}
}