<?php

namespace app\models;

use core\Model;

class CourseCategory extends Model
{
	
	public function getAll():array
	{
		$response = $this->callApi('core_course_get_categories', '');

		return $response;
	}

	public function save(array $arg):array
	{
		$parameter = $this->saveCourseCategory($arg);

		$response = $this->callApi('core_course_create_categories', $parameter);

		dd($response);

		$return_api = $this->verifyErrorApiSave($response);

		return $return_api;	
	}


}