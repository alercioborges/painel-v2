<?php

namespace app\traits;

use app\src\ExecuteCurl;
use app\Config;

trait Api{

	private $uri = Config::MOODLE_DOMAIN
	. 'webservice/rest/server.php?wstoken='
	. Config::MOODLE_TOKEN
	. '&moodlewsrestformat=json&wsfunction=';

	private $format = '&moodlewsrestformat=json&';

	protected function callApi(String $function, String $parameters):array
	{
		$url = $this->uri . $function . $this->format . $parameters;

		$reponse = ExecuteCurl::runCurl($url);

		return $reponse;
	}

	protected function saveParameters(array $arg):String
	{
		$username = '&users[0][username]=' . strtolower($arg['username']);
		$auth = '&users[0][auth]=manual';
		$password = '&users[0][password]=' . urlencode($arg['password']);
		$firstname = '&users[0][firstname]=' . urlencode(strtoupper($arg['firstname']));
		$lastname = '&users[0][lastname]=' . urlencode(strtoupper($arg['lastname']));
		$email = '&users[0][email]=' . strtolower($arg['email']);

		$parameter = $username.$auth.$password.$firstname.$lastname.$email;

		return $parameter;
	}

	protected function verifyErrorApi(array $response):array
	{
		if (isset($response[0]['username']) && $response[0]['username'] == strtolower($_POST['username'])) {
			$return_api = array('message' => "Deu certo", 'cod' => 0);
		}
		elseif (in_array("Email address already exists: {$_POST['email']}", $response)) {
			$return_api = array('message' => "Este email já existe", 'cod' => 1);
		}
		elseif (in_array("Username already exists: {$_POST['username']}", $response)) {
			$return_api = array('message' => "Este nome de usuário já existe", 'cod' => 2);
		}
		elseif (isset($response['message']) && str_contains($response['message'], 'error/')) {
			$return_api = array('message' => $response['errorcode'], 'cod' => 3);
		}		
		else {
			$return_api = array_values($response);
		}

		return $return_api;
	}
}