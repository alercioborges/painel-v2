<?php

namespace app\controllers;

use core\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class OverviewController extends Controller
{
	
	function index(Reques $request, Response $response): Response
	{		
		$this->view('pages/base.twig', [
			'TITLE' => 'Visão Geral'
		]);

		return $response;
	}
}
