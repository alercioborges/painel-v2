<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use app\models\CourseCategory;
use core\Controller;

class CourseCategoryController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$courseCategory = new CourseCategory();
		
		$courseCategories = $courseCategory->getAll();

		$this->view('pages/course-categories.html', [
			'TITLE' => 'Lissta de categorias de curso',
			'COURSE_CATEGORY' => $courseCategories
		]);

		return $response;
	}

	public function create(Reques $request, Response $response):Response
	{
		$this->view('pages/course-categories-create.html', [
			'TITLE' => 'Criar categoria de curso'
		]);

		return $response;
	}

	public function save(Reques $request, Response $response):Response
	{
		dd($_POST);

		return $response;
	}


}