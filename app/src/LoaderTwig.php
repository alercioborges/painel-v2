<?php

namespace app\src;

class LoaderTwig
{
	public function twig($tamplate)
	{
		$loader = new \Twig\Loader\FilesystemLoader($tamplate);

		$twig = new \Twig\Environment($loader, [
			'cache' => dirname(__DIR__) . '/views/cache',
			'cache' => (string)\app\config\App::config()->get('debug'),
			'debug' => \app\config\App::config()->get('debug')
		]);

		$twig->addExtension(new \Twig\Extension\DebugExtension());
		$twig->addGlobal('session', $_SESSION);
		$twig->addGlobal('get', $_GET);
		$twig->addGlobal('base_path', \app\config\App::config()->get('url'));

		return $twig;

	}
}