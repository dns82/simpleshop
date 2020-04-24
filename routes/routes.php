<?php

$klein->respond('GET', '/', function ($request) {
    $controller = new app\controllers\IndexController();
    $controller->index();
});

$klein->respond('GET', '/catalog/?', function ($request, $response) {
    $controller = new app\controllers\CatalogController($request->p);
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond('GET', '/catalog/[:category_handle]/?', function ($request, $response) {
    $controller = new app\controllers\CatalogController($request->p, $request->category_handle);
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond('GET', '/products/[:product_handle]', function ($request, $response) {
    $controller = new app\controllers\ProductController();
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond('GET', '/catalog/[:category_handle]/products/[:product_handle]', function ($request, $response) {
	$controller = new app\controllers\ProductController();
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond('GET', '/cart/?', function ($request, $response) {
    $controller = new app\controllers\CartController();
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond(array('POST', 'GET'), '/cart/[:action]/?', function ($request, $response) {
    $controller = new app\controllers\CartController();
	$controller->request = $request;
	$controller->response = $response;
	if (!empty($request->action) && method_exists($controller, $request->action)) {
		$action = $request->action;
		$controller->{$action}();
	}else{
		$controller->index();
	}
});

$klein->respond('GET', '/checkout/?', function ($request, $response) {
    $controller = new app\controllers\CheckoutController();
	$controller->request = $request;
	$controller->response = $response;
    $controller->index();
});

$klein->respond(array('POST', 'GET'), '/checkout/[:action]/?', function ($request, $response) {
    $controller = new app\controllers\CheckoutController();
	$controller->request = $request;
	$controller->response = $response;
	if (!empty($request->action) && method_exists($controller, $request->action)) {
		$action = $request->action;
		$controller->{$action}();
	}else{
		$controller->index();
	}
});