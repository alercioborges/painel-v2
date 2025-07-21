<?php

use app\src\LoaderTwig;
use app\models\User;

function renderTemplate(String $view, array $data = [])
{	
	$loadTwig = new LoaderTwig();
	$twig = $loadTwig->twig('../app/views/templates/partials/output/');

	$template = $twig->load($view);   
	return $template->display($data);
}

$get_full_url = new Twig\TwigFunction('get_full_url', function()
{
	$isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
	$protocol = $isHttps ? 'https://' : 'http://';

	$full_url = $protocol . $_SERVER['HTTP_HOST'] . \app\config\App::config()->get('dir');

	return $full_url;
});

$message = new Twig\TwigFunction('message', function($type)
{
	echo app\src\Flash::get($type);
});

$pagination = new Twig\TwigFunction('pagination', function($numPages)
{
	return renderTemplate('pagination.twig', ['numPages' => $numPages]);
});

$userLoggedData = new Twig\TwigFunction('userLoggedData', function()
{
	$user = new user();
	return $user->get($_SESSION['idLoggedIn']);
});

return[
	$get_full_url,
	$message,
	$pagination,
	$userLoggedData
];