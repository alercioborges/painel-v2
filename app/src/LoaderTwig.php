<?php

namespace app\src;

class LoaderTwig
{
	public function twig($tamplate)
	{
		$loader = new \Twig\Loader\FilesystemLoader($tamplate);

		$twig = new \Twig\Environment($loader, [
			'cache' => '../app/views/cache',
			'cache' => false,
			'debug' => $_ENV['APP_DEBUG']
		]);

		$twig->addExtension(new \Twig\Extension\DebugExtension());
		$twig->addGlobal('session', $_SESSION);
		$twig->addGlobal('get', $_GET);

		return $twig;

	}
}