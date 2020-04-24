<?php

namespace app\helpers;

use app\models\Category;

class Breadcrumbs
{	

	protected $breadcrumbs = '';

	function __construct() {
		$this->breadcrumbs .= '<a href="/">Home</a>';
	}
	
	public function getBreadcrumbs(){
		return $this->breadcrumbs;
	}
	
	public function addItem($title = '', $link = ''){
		if (!empty($title)) {
			if (!empty($link)) {
				$this->breadcrumbs .= '<a href="'.$link.'"> / '.$title.'</a>';
			} else {
				$this->breadcrumbs .= ' / '.$title;
			}
		}
	}
	
	public function genereteCatalogItems($currentCategoryId = 0){
		
		if ($currentCategoryId) {
			
			$this->addItem('Catalog', '/catalog');
			
			$currentCategory = Category::find($currentCategoryId);
			$parentCategories = $currentCategory->getParentCategories();
			
			if ($parentCategories) {
				foreach ($parentCategories as $cat) {
					$this->addItem($cat->category_name, '/catalog/'.$cat->handle);
				}
			}
			
			if ($currentCategory) {
				$this->addItem($currentCategory->category_name);
			}
		} else {
			$this->addItem('Catalog');
		}
	}
	
	public function genereteProductItems($productName = '', $categoryHandle = ''){
		
		$this->addItem('Catalog', '/catalog');
		
		if (!empty($categoryHandle)) {
			$category = Category::where(['handle' => $categoryHandle])->first();

			$parentCategories = $category->getParentCategories();
			if ($parentCategories) {
				foreach ($parentCategories as $cat) {
					$this->addItem($cat->category_name, '/catalog/'.$cat->handle);
				}
			}
			
			$this->addItem($category->category_name, '/catalog/'.$category->handle);
		}
		
		if (!empty($productName)) {
			$this->addItem($productName);
		}
	}
}