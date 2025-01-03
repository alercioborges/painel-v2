<?php

namespace app\traits\lms;

trait User{

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

		$email = '&users[0][email]=' . strtolower($arg['email']);
		$username = '&users[0][username]=' . strtolower($arg['username']);
		$auth = '&users[0][auth]=manual';
		$firstname = '&users[0][firstname]=' . urlencode(mb_strtoupper($arg['firstname']));
		$lastname = '&users[0][lastname]=' . urlencode(mb_strtoupper($arg['lastname']));
				
		$parameter = $username.$auth.$firstname.$lastname.$email;
		
		return $parameter;
	}

}