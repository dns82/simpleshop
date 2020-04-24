define(function(require) {
	
	var $ = require('jquery');
	var bootstrap = require('bootstrap.bundle.min');    
	
	$(function(){
		$('.wrap-cart-count').popover({
			container: 'body',
			html: true,
			template: '<div class="popover"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body popover-mini-cart-body"></div></div>'
		})
	});



});
