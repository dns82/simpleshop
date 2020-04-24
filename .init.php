<?php

error_reporting(E_ALL);

define('ROOT_PATH', __DIR__ . '/');
define('VIEWS_PATH', ROOT_PATH . 'app/views/');
define('BUILD_PATH', ROOT_PATH . 'public/assets/final/');

$configFiles = glob( ROOT_PATH . 'config/*.php');
if(count($configFiles) < 1){
	echo 'Please define config files';
	return;
}

foreach ( $configFiles as $file ) {
    require_once $file;
}

//init db connection
new \lib\Db();

//init routes
$routeFiles = glob( ROOT_PATH . 'routes/*.php' );
if(count($routeFiles) < 1){
	echo 'Please define route files';
	return;
}

$klein = new \Klein\Klein();

foreach ( $routeFiles as $file ) {
    require_once $file;
}

$klein->dispatch();