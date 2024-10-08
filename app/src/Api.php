<?php

namespace app\src;

use app\src\ExecuteCurl;
use app\Config;

class Api
{

	public static function callApi(String $function, String $parameters):array
	{

		$uri = Config::MOODLE_DOMAIN
		. 'webservice/rest/server.php?wstoken='
		. Config::MOODLE_TOKEN
		. '&moodlewsrestformat=json&wsfunction=';

		$format = '&moodlewsrestformat=json&';

		$url = $uri . $function . $format . $parameters;
		$response = ExecuteCurl::runCurl($url);

		if (array_key_exists('exception', $response)) {
			throw new \Exception("Error: {$response['message']}");			
		}

		return $response;
		
	}

}