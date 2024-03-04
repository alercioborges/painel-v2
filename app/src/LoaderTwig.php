<?php

namespace app\src;

class LoaderTwig
{	
	private $twig;

	protected function twig($tamplate)
	{
		$loader = new \Twig\Loader\FilesystemLoader($tamplate);

		$this->twig = new \Twig\Environment($loader, [
			'cache' => '../app/views/cache',
			'cache' => false,
			'debug' => true
		]);

		$this->twig->addExtension(new \Twig\Extension\DebugExtension());
		$this->twig->addGlobal('session', $_SESSION);
		$this->twig->addGlobal('get', $_GET);

		return $this->twig;

	}
}