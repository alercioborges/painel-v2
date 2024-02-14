<?php

namespace app\models;

use core\Model;

class Course extends Model
{

	public function getAll()
	{

		$categories = $this->select(
			['id', 'name', 'path'],
			'mdl_course_categories'
		)->orderBy('sortorder')->get();

		$courses = [];

		foreach ($categories as $key => $value) {

			$courses[$key]['id_category'] = $value['id'];
			$courses[$key]['name_category'] = $value['name'];
			$courses[$key]['path'] = $value['path'];
			$courses[$key]['courses'] = $this->select([ 
				'mdl_course.id',
				'mdl_course.fullname',
				'mdl_course.idnumber',
				'mdl_course.category'],
				'mdl_course'
			)->where('category', $value['id'])->get();

			$path  = $this->select(
				['path'],
				'mdl_course_categories'
			)->where('path', 'LIKE', "/{$value['id']}/%")->get();

			if ($path != NULL) {

				$id_subcategorie = [];

				foreach ($path  as $key_path => $value_path) {
					$path_categories[$key_path] = explode('/', $value_path['path']);

					if (!in_array($path_categories[$key_path][2], $id_subcategorie)) {
						$id_subcategorie[] = $path_categories[$key_path][2];
					}					

				}

				foreach ($id_subcategorie as $key_sub => $value_sub) {
					$courses[$key]['subcategory'][$key_sub] = $id_subcategorie[$key_sub];

					$subcategories = $this->select(
						['id', 'name', 'path'],
						'mdl_course_categories'
					)->where('id', $courses[$key]['subcategory'][$key_sub])->get();
				}
			}
		}

		return $courses;
	}

}

