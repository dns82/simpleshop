<?php

namespace lib;

use lib\Session;
use app\models\Product;

class Cart
{		

	private static $qty = 0;
	
	private static $totalAmount = 0;

	function __constructor(){
		self::init();
	}

	public static function __callStatic($name, $args)
    {
        $func = '_'.$name;
        self::before();
        if (method_exists(Cart::class, $func)) {
			return call_user_func_array(array(Cart::class, $func), $args);
        }
    }
	
	private static function before(){
        self::init();
    }

    private static function after(){
        return true;
    }
	
	private static function init(){
		$session = Session::getInstance();
		//Session::destroy();
		$cart = $session->cart;
		
		if (!isset($cart)) {
			$session->cart = [];
		}
		
	}
	
	private static function getCart(){
        $session = Session::getInstance();
		$cart = $session->cart;
		
		return $cart;
    }
	
	private static function setCart($cart){
		$session = Session::getInstance();
		$session->cart = $cart;
	}

	public static function _add($product_id = 0, $qty = 1, $price = 0){
		if (!$product_id) {
			return false;
		}
		
		$cart = self::getCart();	
		
		$finalQty = !isset($cart[$product_id]) ? $qty : $cart[$product_id]['qty'] + $qty;
		
		$cart[$product_id] = ['qty' => $finalQty, 'price' => $price];

		self::setCart($cart);
		
		return true;
	}
	
	public static function _update($items = array()){
		if (empty($items)) {
			return false;
		}
		
		$cart = self::getCart();	
		
		foreach ($items as $item) {
			if (isset($item['id']) && isset($item['qty']) && isset($cart[$item['id']])) {
				if ($item['qty'] == 0) {
					unset($cart[$item['id']]);
				} else {
					$cart[$item['id']]['qty'] = $item['qty'];
				}
			}
		}

		self::setCart($cart);
		
		return true;
	}
	
	public static function _remove($product_id = 0){
		if (!$product_id) {
			return false;
		}
		
		$cart = self::getCart();
				
		if (isset($cart[$product_id])) {
			unset($cart[$product_id]);
		}
		
		self::setCart($cart);
		
		return true;
	}
	
	public static function _clear(){
		
		$cart = self::getCart();
		
		$cart = [];
		
		self::setCart($cart);
		
		return true;
	}
	
	public static function _getItems(){
		$cart = self::getCart();
		$items = [];
		
		if (!empty($cart)) {
			foreach ($cart as $id => $item) {
				$product = Product::find($id);
				if ($product) {
					$items[$id] = array('qty' => $item['qty'],
									'price'  => $item['price'],
									'name'	 => $product->product_name,
									'image'	 => $product->image,
									'handle' => $product->handle
								);
				}
			}
		}
		
		return $items;
	}
	
	public static function _getQty(){
		$cart = self::getCart();
		
		self::$qty = 0;
		
		if (!empty($cart)) {
			foreach ($cart as $item) {
				self::$qty += ((isset($item['qty'])) ? $item['qty'] : 0);
			}
		}
		
		return self::$qty;
	}
	
	public static function _getTotalAmount(){
		$cart = self::getCart();
		
		self::$totalAmount = 0;
		
		if (!empty($cart)) {
			foreach ($cart as $item) {
				self::$totalAmount += ((isset($item['price']) && isset($item['qty'])) ? $item['price'] * $item['qty'] : 0);
			}
		}
		
		return self::$totalAmount;
	}
	
	public static function _getMiniCartContents(){
		if (self::$qty > 0) {
			return 'Total Amount: $'. self::_getTotalAmount() . '<br /> <div class=\'mini-cart-link\'><a href=\'/cart\'>View Cart</a></div>';
		} else {
			return 'There aren\'t any items<br /> in the shopping cart.';
		}
	}
}