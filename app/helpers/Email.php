<?php

namespace app\helpers;

use PHLAK\Config\Config;
use Swift_Mailer;
use Swift_SmtpTransport;
use Swift_Message;
use lib\View;

class Email
{	
	
	protected $transport = null;
	protected $template = '';
	CONST TEMPLATE_PATH = 'emails/';
	
	protected $fromEmail = '';
	protected $fromName = '';
	protected $adminEmail = '';
	
	function __construct() {
		
		if (!$this->transport) {
			
			$configServices = new Config(ROOT_PATH . 'config/services.php');
			$smtp = $configServices->get('smtp_credits');
			
			$this->transport = (new Swift_SmtpTransport($smtp['host'], $smtp['port']))
				->setUsername($smtp['username'])
				->setPassword($smtp['password']);
			
			$configGeneral = new Config(ROOT_PATH . 'config/general.php');
			
			$this->fromEmail = $configGeneral->get('from_email');
			$this->fromName = $configGeneral->get('from_name');
			$this->adminEmail = $configGeneral->get('admin_email');
		}
	}
	
	public function sendOrderConfirmation($order_id = 0){
		
		if (empty($this->fromEmail) || empty($this->fromName) || empty($this->adminEmail) || empty($this->template)) {
			return false;
		}
		
		try {
			
			$order = \app\models\Order::find($order_id);
			
			if	(!$order) {
				return false;
			}
			
			$mailer = new Swift_Mailer($this->transport);
			$view = new View();
			
			$view->setLayout('layout/email.php');
			
			$body = $view->renderer(self::TEMPLATE_PATH . $this->template, [
										'order' => $order
									]);
			
			// Create a message
			$message = (new Swift_Message('Order Confirmation'))
				->setFrom([$this->fromEmail => $this->fromName])
				//->setTo([$order->email, $this->adminEmail])
				->setTo([$order->email, $this->adminEmail])
				->setBody($body, 'text/html');

			// Send the message
			$result = $mailer->send($message);
			return $result;
			
		} catch (\Exception $e){
			return false;
		}

	}
	
	public function setTemplate($template = ''){
		$this->template = $template;
	}
	
}