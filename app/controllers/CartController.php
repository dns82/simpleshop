<?php

namespace app\controllers;

use app\models\Product;
use lib\Cart;
use lib\View;
use app\helpers\Email;

class CartController extends \lib\BaseController
{
	
	public function index() 
	{	
	
		$view = new View();
		
		$modalsView = $view->view->fetch('checkout/cart/modals.php', []);
				
		$view->setLayout('layout/main.php');
		
		$cartView = $view->renderer("checkout/cart/cart.php", [
										'cartItems' => Cart::getItems(),
										'modals' 	=> $modalsView,
										'total' 	=> Cart::getTotalAmount()
									]);
									
		echo $cartView;
	}
	
	public function add() 
	{			
		if (isset($this->request->ajax) && $this->request->ajax == 1 && isset($this->request->product_id) && isset($this->request->qty)) {
			$product = Product::find($this->request->product_id);

			if ($product && Cart::add($product->id, $this->request->qty, $product->price)) {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 0, 'message' => 'The product was added to the shopping cart successfully.']);
			} else {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 1, 'message' => 'There was a problem with an adding of the product to the shopping cart.']);
			}
		} else {
			echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 1, 'message' => 'There was a problem with an adding of the product to the shopping cart.']);
		}
	}
	
	public function remove() 
	{					
		if (isset($this->request->ajax) && $this->request->ajax == 1 && isset($this->request->product_id)) {
			if (Cart::remove($this->request->product_id)) {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 0, 'message' => 'The product was removed from the shopping cart successfully.']);
			} else {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with a removing of the product from the shopping cart.']);
			}
		} else {
			echo json_encode(['qty' => Cart::getQty(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with a removing of the product from the shopping cart.']);
		}
		
	}
	
	public function clear() 
	{	
		if (isset($this->request->ajax)) {
			if (Cart::clear()) {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 0, 'message' => 'The shopping cart was cleared successfully.']);
			} else {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with a clearing of the shopping cart.']);
			}
		} else {
			echo json_encode(['qty' => Cart::getQty(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with a clearing of the shopping cart.']);
		}
	}
	
	public function update() 
	{			
		if (isset($this->request->ajax) && $this->request->ajax == 1 && !empty($this->request->items)) {
			if (Cart::update($this->request->items)) {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 0, 'message' => 'The shopping cart was updated successfully.']);
			} else {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with an updating of the shopping cart.']);
			}
		} else {
			echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'total' => Cart::getTotalAmount(), 'error' => 1, 'message' => 'There was a problem with an updating of the shopping cart.']);
		}
	}
}