<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class OrderItem extends Eloquent 
{
		public $table = 'order_items';
		
		public $timestamps = false;
	
}