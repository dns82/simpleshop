define(function(require) {

	var $ = require('jquery');
	var config = require('app/config');
	var order = require('modules/order');
	var moment = require('moment');
	var datetimepicker = require('bootstrap-datetimepicker.min');

	$(function(){
		$('#inputTime').datetimepicker({
			format: 'HH:mm'
		});
		
		$('.wrap-checkout #checkoutForm').on('submit', function(e){
			e.preventDefault();
			$('.wrap-checkout .btn-process').attr('disabled', true);
			
			order.save($(this).serialize(), config.opts.websiteBaseUrl);
			return false;
		});
	});
	
});
