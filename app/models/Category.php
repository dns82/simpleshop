<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent 
{
		
	public static function getCategories($parent_id = 0){
		
		$categories = self::where([['status', '=', 1], ['parent_id', '=', $parent_id]])
						->orderBy('category_name', 'asc')
						->get();
			   
		return $categories;
	}
	
	public static function getCurrentCategoryId($handle = ''){
		
		$category = self::select('id')->where(['handle' => strtolower($handle), 'status' => 1])->first();
		
		return $category ? $category->id : -1;
	}
	
	public function products(){
        return $this->belongsToMany(Product::class, 'category_product');
    }
	
	public function productsCount(){
        return $this->belongsToMany(Product::class, 'category_product');
    }
	
	public function parent(){
		return $this->belongsTo(Category::class, 'parent_id');
	}
	
	public function getParentCategories(){
		
		$parents = collect([]);

		if ($this->parent) { 
			$parent = $this->parent;
			while (!is_null($parent)) {
				$parents->prepend($parent);
				$parent = $parent->parent;
			}
			return $parents;
		}
	}
	
}