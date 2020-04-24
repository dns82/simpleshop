<?php

namespace lib;

use Slim\Views\PhpRenderer;
use PHLAK\Config\Config;
use GuzzleHttp\Psr7\Response;
use \lib\Cart;

class View extends PhpRenderer
{	

	public $view = null;

	function __construct() {
		
		$config = new Config(ROOT_PATH . 'config/general.php');
		
		if (!$this->view) {		
			$this->view = new PhpRenderer(VIEWS_PATH, [
								'title' => $config->get('website_name'),
								'header_title' => $config->get('website_name'),
								'latest_build_path' => $this->getLatestBuildPath(),
								'breadcrumbs' => ''
							]);
				
			$this->view->addAttribute('mini_cart', $this->view->fetch('checkout/cart/mini.php', ['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents()]));
		}
	}
	
	public function renderer($template = '', $attr = array()){
	
		$response = $this->view->render(new Response(), $template, $attr);
		
		return $response->getBody();
		
	}
	
	public function setLayout($layout = 'layout/main.php'){

		$this->view->setLayout($layout);
	}
	
	public function getLatestBuildPath()
    {
        $lastBuild = '';

        if (is_dir(BUILD_PATH)) {
            chdir(BUILD_PATH);
            array_multisort(array_map('filemtime', ($folders = glob("*"))), SORT_DESC, $folders);

            $lastBuild = '/assets/final/' . $folders[0];
        }

        return $lastBuild;
    }
	
}