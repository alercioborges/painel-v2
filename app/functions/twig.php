<?php

use app\src\LoaderTwig;

function renderTemplate(String $view, array $data = []) {	
	$loadTwig = new LoaderTwig();
	$twig = $loadTwig->twig('../app/views/templates/partials/output/');
	
	$template = $twig->load($view);   
	return $template->display($data);
}

$get_full_url = new Twig\TwigFunction('get_full_url', function()
{
	$isHttps = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on';
	$protocol = $isHttps ? 'https://' : 'http://';

	$full_url = $protocol . $_SERVER['HTTP_HOST'] . app\Config::BASE_DIR;

	return $full_url;
});

$form_message = new Twig\TwigFunction('form_message', function($index)
{
	echo app\src\Flash::get($index);
});

$success_message = new Twig\TwigFunction('success_message', function($index)
{
	echo app\src\Flash::get($index);
});

$pagination = new Twig\TwigFunction('pagination', function($numPages)
{
	return renderTemplate('pagination.twig', ['numPages' => $numPages]);
});

return[
	$get_full_url,
	$form_message,
	$success_message,
	$pagination
];