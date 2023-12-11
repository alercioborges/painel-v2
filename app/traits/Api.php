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
}