<?php

namespace app\controllers;

use core\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class OverviewController extends Controller
{
	
	function index(Reques $request, Response $response): Response
	{		
		$this->view('pages/overview.html', [
			'TITLE' => 'Visão Geral'
		]);

		return $response;
	}
}
