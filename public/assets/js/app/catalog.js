define(function(require) {

	var $ = require('jquery');
	var config = require('app/config');
	var cart = require('modules/cart');

	$(function(){
		$('.wrap-products .link-add-cart a').on('click', function(e){
			cart.add($(this).data('productId'), 1, $(this).data('productPrice'), config.opts.websiteBaseUrl);
		});
	});
	
});
