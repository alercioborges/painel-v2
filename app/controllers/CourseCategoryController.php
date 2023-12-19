<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

use core\Controller;

class CourseCategoryController extends Controller
{
	
	public function show(Reques $request, Response $response):Response
	{
		$this->view('pages/course-categories.html', [
			'TITLE' => 'Lissta de categorias de curso'
		]);

		return $response;
	}

	public function create(Reques $request, Response $response):Response
	{
		$this->view('pages/course-categories-create.html', [
			'TITLE' => 'Cadastrar categoria de curso'
		]);

		return $response;
	}
}