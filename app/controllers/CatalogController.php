<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use lib\View;
use app\helpers\Breadcrumbs;
use app\helpers\Pagination;

class CatalogController extends \lib\BaseController
{
	
	protected $currentCategoryId = 0;	
	protected $currentCategoryUrl = '';
	protected $page = 1;
	
	function __construct($page = 1, $category_handle = '') {
		$this->page = (isset($page)) ? $page : 1;
	
		if (!empty($category_handle)) {
			$this->currentCategoryId = Category::getCurrentCategoryId($category_handle);
			$this->currentCategoryUrl = $category_handle;
		}
	}
	
	public function index() 
	{	

		$breadcrumbs = new Breadcrumbs();
		$breadcrumbs->genereteCatalogItems($this->currentCategoryId);

		$pagination = new Pagination($this->page, 6);
	
		$categories = Category::getCategories($this->currentCategoryId);
		$productsModel = new Product();
		$products = $productsModel->getProducts($this->currentCategoryId, $pagination->getCurrentPage(), $pagination->getOffset(), $pagination->getItemsPerPage());
		
		$pagination->setTotalRecords($productsModel->getTotalSelectedRecords());
		
		$view = new View();
		
		$paginationView = $view->view->fetch('layout/pagination/pagination.php', [
																		'currentPage' => $pagination->getCurrentPage(),
																		'firstPage' => $pagination::FIRST_PAGE,
																		'previousPage' => $pagination->getPreviousPage(),
																		'lastPage' => $pagination->getLastPage(),
																		'nextPage' => $pagination->getNextPage(),
																	]);
		
		$poductsView = 	$view->view->fetch('catalog/products.php', [
														'products' => $products, 
														'pagination' => $paginationView,
														'current_category_url' => $this->currentCategoryUrl,
													]);
		
		$modalsView = $view->view->fetch('checkout/cart/modals.php', []);
		
		$view->setLayout('layout/main.php');
		
		$catalogView = $view->renderer("catalog/list.php", [
										'categories' => $categories, 
										'products' => $poductsView,
										'breadcrumbs' => $breadcrumbs->getBreadcrumbs(),
										'modals' => $modalsView
									]);

		echo $catalogView;
	}
	
}