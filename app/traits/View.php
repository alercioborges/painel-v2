<?php

namespace app\traits;

use app\src\Load;
use app\src\LoaderTwig;


trait View{

	protected $twig;

	
	protected function twig()
	{
		
		$loadTwig = new LoaderTwig();
		$this->twig = $loadTwig->twig('../app/views/templates');

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