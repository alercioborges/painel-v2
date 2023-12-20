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
}