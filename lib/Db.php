<?php

namespace lib;

use Illuminate\Database\Capsule\Manager as Capsule;
use PHLAK\Config\Config;

class Db extends Capsule
{	
	function __construct() {
		
		try{
		
			$config = new Config(ROOT_PATH . 'config/database.php');
			
			$capsule = new Capsule;
			
			$capsule->addConnection($config->get('db_credits'));
			
			//Make this Capsule instance available globally.
			$capsule->setAsGlobal();
			
			// Setup the Eloquent ORM
			$capsule->bootEloquent();
			
		} catch (Exception $e) {
			echo 'Exception: ',  $e->getMessage(), "\n";
		}
	}
	
}