<?php

namespace app\src;

class Load
{
	public static function file(string $file):mixed
	{
		
		$file = path().$file;

		if (!file_exists($file)) {
			throw new \Exception("Este arquivo não existe: ($file)");
			
		}

		return require $file;		
	}

}