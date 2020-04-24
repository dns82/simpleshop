<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use lib\View;
use app\helpers\Breadcrumbs;

class ProductController extends \lib\BaseController
{
	
	public function index(){	

		$product = Product::where(['handle' => $this->request->product_handle, 'status' => 1])->first();
		
		if (!$product) {
			$this->response->redirect('/catalog'); 
			return true;
		}
	
		$breadcrumbs = new Breadcrumbs();
		$breadcrumbs->genereteProductItems($product->product_name, $this->request->category_handle);
	
		$view = new View();
		
		$modalsView = $view->view->fetch('checkout/cart/modals.php', []);
		
		$view->setLayout('layout/main.php');
		
		$productView = $view->renderer("product/view.php", [
										'product' => $product,
										'breadcrumbs' => $breadcrumbs->getBreadcrumbs(),
										'modals' => $modalsView
									]);
									
		echo $productView;
		
	}
	
}