<?php

namespace app\models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Order extends Eloquent 
{	

	public $timestamps = true;

	public function items(){
		return $this->hasMany('\app\models\OrderItem');
    }

}