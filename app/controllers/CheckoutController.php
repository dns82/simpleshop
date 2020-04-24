<?php

namespace app\controllers;

use app\models\Product;
use lib\Cart;
use app\models\Order;
use app\models\OrderItem;
use lib\View;
use lib\Db;
use app\helpers\Email;

class CheckoutController extends \lib\BaseController
{
	
	public function index() {	

		if (Cart::getQty() < 1){
			$this->response->redirect('/cart'); 
			return true;
		}

		$view = new View();
		
		$modalsView = $view->view->fetch('checkout/cart/modals.php', []);
		
		$modalsReview = $view->view->fetch('checkout/review.php', [
										'cartItems' => Cart::getItems(),
										'total' 	=> Cart::getTotalAmount(),
									]);	

		$view->setLayout('layout/main.php');
		
		$checkoutView = $view->renderer("checkout/checkout.php", [
										'modals' 	=> $modalsView,
										'review' 	=> $modalsReview
									]);
									
		echo $checkoutView;
	}
	
	public function save(){
		
		$error = false;
		
		if (isset($this->request->ajax) && $this->request->ajax == 1 && !empty($this->request->customer_data)) {
			
			parse_str($this->request->customer_data, $customer_data);

			if (empty($customer_data)) {
				$error = true;
			}
			
			$cart = Cart::getItems();
			
			if (empty($cart)) {
				$error = true;
			}
			
			if (!$error) {
				$orderId = 0;
				$order = new Order();
		
				$order->first_name = (isset($customer_data['first_name'])) ? $customer_data['first_name'] : '';
				$order->last_name = (isset($customer_data['last_name'])) ? $customer_data['last_name'] : '';
				$order->email = (isset($customer_data['email'])) ? $customer_data['email'] : '';
				$order->phone = (isset($customer_data['phone'])) ? $customer_data['phone'] : '';
				$order->address = (isset($customer_data['address'])) ? $customer_data['address'] : '';
				$order->city = (isset($customer_data['city'])) ? $customer_data['city'] : '';
				$order->state = (isset($customer_data['state'])) ? $customer_data['state'] : '';
				$order->zipcode = (isset($customer_data['zipcode'])) ? $customer_data['zipcode'] : '';
				$order->country = (isset($customer_data['country'])) ? $customer_data['country'] : '';
				$order->delivery_date = (isset($customer_data['delivery_date'])) ? $customer_data['delivery_date'] : '';
				$order->delivery_time = (isset($customer_data['delivery_time'])) ? $customer_data['delivery_time'] : '';
				$order->total_amount = Cart::getTotalAmount();
				
				try {
					Db::beginTransaction();

					$order->save();
					$orderId = $order->id;
					
					foreach ($cart as $product_id => $_item) {
						$item = new OrderItem();
						$item->order_id = $order->id;
						$item->product_id = $product_id;
						$item->product_name = $_item['name'];
						$item->qty = $_item['qty'];
						$item->price = $_item['price'];
						$item->subtotal = $_item['qty'] * $_item['price'];

						$item->save();
					}
					
					Db::commit();
					
					$email = new Email();
					$email->setTemplate('new_order.php');
					$email->sendOrderConfirmation($orderId);
					
					Cart::clear();
					echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 0, 'order_id' => $orderId, 'message' => 'The checkout process was finished successfully.']);
				} catch(\Exception $e) {
					Db::rollback();
					echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 1, 'message' => 'There was a problem with a finishing of checkout process.']);
				}
			
			}
			
			if ($error) {
				echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 1, 'message' => 'There was a problem with a finishing of checkout process.']);
			}

		} else {
			echo json_encode(['qty' => Cart::getQty(), 'contents' => Cart::getMiniCartContents(), 'error' => 1, 'message' => 'There was a problem with a finishing of checkout process.']);
		}
	}
}