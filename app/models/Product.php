<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use app\models\Category;

class Product extends Eloquent 
{
	protected $totalSelectedRecords = 0;
	
	public function getProducts($category_id = 0, $page = 1, $offset = 0, $products_per_page = 6){
		
		if ($category_id == 0) {
			
			$query = self::where([['status', '=', 1]])
							->orderBy('product_name', 'asc');
			
			$this->totalSelectedRecords = $query->count();
			$products = $query->skip($offset)->take($products_per_page)->get();
			
		} else {
			$category = Category::where(['id' => $category_id, 'status' => 1])
									->with(['products' => function($query) use ($offset, $products_per_page) {
												$query->where('status', 1)->skip($offset)->take($products_per_page)->orderBy('product_name', 'asc');
											}
									])
									->withCount(['productsCount as products_count' => function($query) {
												$query->where('status', 1);
											}
									])
									->first();
														
			$this->totalSelectedRecords = $category->products_count;
			
			$products = ($category) ? $category->products : null;
		}
		 
		return $products;
	}
	
	public function getTotalSelectedRecords(){
		return $this->totalSelectedRecords;
	}
	
}