<?php

namespace app\src;

class ExecuteCurl
{
	public static function runCurl($url)
	{
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 0);  
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 

		$response = curl_exec($ch);
		
		if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			curl_close($ch);
			return throw new \Exception("Error: {$error_msg}");
		}

		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		if ($http_code != 200) {
			curl_close($ch);
			return throw new \Exception("Error: HTTP $http_code");
		}

		curl_close($ch);
		
		return json_decode($response, true);		

	}

}