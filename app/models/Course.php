<?php

namespace app\models;

use core\Model;

class Course extends Model
{
	public function getAll()
	{
		$courses_id = $this->select(
			['id'],
			'mdl_course'
		)
		->where('id', '!=', '1')
		->get();
		
		
		$courses = $this->select(
			[
				'mdl_course.id',
				'mdl_course.fullname',
				'mdl_course.idnumber',
				'mdl_course_categories.id as id_category',
				'mdl_course_categories.name as name_category',
				'mdl_course_categories.path as path_category'
			],
			'mdl_course'
		)
		->innerJoin('mdl_course_categories', 'mdl_course_categories.id', '=', 'mdl_course.category'		)
		->where('mdl_course.id', '!=', '1')
		->where('mdl_course_categories.path', 'LIKE', '%/5/%')
		->orwhere('mdl_course_categories.path', 'LIKE', '%/5')
		->get();
		
		return $courses;
	}

}