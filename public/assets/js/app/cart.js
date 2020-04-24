define(function(require) {

	var $ = require('jquery');
	var config = require('app/config');
	var cart = require('modules/cart');

	$(function(){
				
		$('.wrap-cart .table-products .fa-trash-alt').on('click', function(){
			cart.remove($(this).data('productId'), config.opts.websiteBaseUrl);
		});
		
		$('.wrap-cart .cart-actions .btn-remove-all').on('click', function(){
			cart.clear(config.opts.websiteBaseUrl);
		});
		
		$('.wrap-cart .cart-actions .btn-update').on('click', function(){
			var items = [];
			
			$('.table-products tr.row-product').each(function(){
				var qty = parseInt($(this).find('.input-qty').val().trim());
				qty = isNaN(qty) ? 1 : qty;
				
				var id = parseInt($(this).find('.fa-trash-alt').data('productId'));
				id = isNaN(qty) ? 0 : id;
				
				items.push({qty:qty, id: id});
			});
			
			cart.update(items, config.opts.websiteBaseUrl);
		});
	});
	
});
