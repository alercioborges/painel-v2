<?php

namespace app\src;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Routing\RouteContext;

class Middleware
{

	public function logged()
	{
		$logged = function (Request $request, $handler): Response {

			if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {				
				$routeParser = RouteContext::fromRequest($request)->getRouteParser();
                $response = new \Slim\Psr7\Response();
                return $response->withHeader('Location', $routeParser->urlFor('login'))->withStatus(302);
			}

			return $handler->handle($request);		

		};

		return $logged;

	}
}