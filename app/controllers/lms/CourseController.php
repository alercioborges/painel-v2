<?php

namespace app\controllers\lms;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

use app\models\lms\Course;

class CourseController extends Controller
{	
	public function show(Reques $request, Response $response):Response
	{
		$course = new Course();

		$courses = $course->getAll();

		$this->view('pages/courses.html', [
			'TITLE' => 'Lissta de cursos',
			'COURSES' => $courses
		]);

		return $response;
	}
}
