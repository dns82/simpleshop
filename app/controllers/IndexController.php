<?php

namespace app\controllers;

use PHLAK\Config\Config;
use lib\View;

class IndexController 
{
	
	public function index() 
	{	
		
		$config = new Config(ROOT_PATH . 'config/general.php');
		
		$view = new View();
		
		$view->setLayout('layout/home.php');
		
		$response = $view->renderer('homepage/home.php', []);

		echo $response;
		
	}
	
}