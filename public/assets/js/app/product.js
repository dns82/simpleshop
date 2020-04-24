define(function(require) {
	
	var $ = require('jquery');
	var config = require('app/config');
	var cart = require('modules/cart');

	$(function(){
		
		$('.wrap-product #productForm').on('submit', function(e){
			e.preventDefault();
			
			var qty = parseInt($('#qty').val().trim());
			qty = isNaN(qty) ? 1 : qty;
			
			cart.add($('.wrap-product .btn-submit').data('productId'), qty, $('.wrap-product .btn-submit').data('productPrice'), config.opts.websiteBaseUrl);
			return false;
		});
	});
	
});
