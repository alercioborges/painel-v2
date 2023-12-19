<?php

namespace app\traits;

use app\src\Load;

trait View{

	protected $twig;

	protected function twig()
	{
		$loader = new \Twig\Loader\FilesystemLoader('../app/views/templates');

		$this->twig = new \Twig\Environment($loader, [
			'cache' => '../app/views/cache',
			'cache' => false,
			'debug' => true
		]);

		$this->twig->addExtension(new \Twig\Extension\DebugExtension());
		$this->twig->addGlobal('session', $_SESSION);

	}


	protected function functions()
	{
		$functions = Load::file('/app/functions/twig.php');

		foreach ($functions as $function) {
			$this->twig->addFunction($function);
		}
	}

	protected function load()
	{
		$this->twig();
		$this->functions();
	}


	protected function view(String $view, array $data = [])
	{
		$this->load();

		$template = $this->twig->load($view);

		return $template->display($data);

	}

}