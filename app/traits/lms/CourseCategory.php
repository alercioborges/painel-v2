<?php

namespace app\traits\lms;

trait ApiCourseCategory
{

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

