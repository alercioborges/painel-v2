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
		$response = ExecuteCurl::runCurl($url);

		if (array_key_exists('exception', $response)) {
			throw new \Exception("Error: {$response['message']}");			
		}

		return $response;
		
	}

	protected function saveParameters(array $arg):String
	{		
		$password = '&users[0][password]=' . urlencode($arg['password']);
		$parameter_user = $this->setUserDataApiParameter($arg);

		$parameter = $parameter_user.$password;

		return $parameter;
	}

	protected function updateParameters(array $arg):String
	{
		$id = '&users[0][id]=' . $arg['id'];
		$parameter_user = $this->setUserDataApiParameter($arg);

		$parameter = $id.$parameter_user;

		return $parameter;
	}

	private function setUserDataApiParameter(array $arg):String
	{
		mb_internal_encoding('UTF-8');

		$username = '&users[0][username]=' . strtolower($arg['username']);
		$auth = '&users[0][auth]=manual';
		$firstname = '&users[0][firstname]=' . urlencode(mb_strtoupper($arg['firstname']));
		$lastname = '&users[0][lastname]=' . urlencode(mb_strtoupper($arg['lastname']));
		$email = '&users[0][email]=' . strtolower($arg['email']);
		
		$parameter = $username.$auth.$firstname.$lastname.$email;
		
		return $parameter;
	}	

	protected function saveCourseCategory(array $arg):String
	{		
		$name = '&categories[0][name]=' . urlencode($arg['name']);
		$parent = '&categories[0][parent]=' . $arg['parent'];
		$idnumber = '&categories[0][idnumber]=' . urlencode($arg['idnumber']);
		$description = '&categories[0][description]=' . urlencode($arg['description']);

		$parameter = $name.$parent.$idnumber.$description;

		return $parameter;
	}
}