<?php

namespace app\controllers;

use core\Controller;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Reques;

class HiController extends Controller
{
	
	function index(Reques $request, Response $response): Response
	{		
		$this->view('pages/hi.twig', [
			'TITLE' => 'Olá'
		]);

		return $response;
	}
}
