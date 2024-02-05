<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\Course;



class CourseController extends Controller
{	
	public function show(Reques $request, Response $response):Response
	{
		$course = new Course();

		$courses = $course->getAll();

		dd($courses);

		$this->view('pages/courses.html', [
			'TITLE' => 'Lissta de cursos'
		]);

		return $response;
	}
}
