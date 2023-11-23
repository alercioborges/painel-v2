<?php

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



return[
	$get_full_url,
	$form_message
];