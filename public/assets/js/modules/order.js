define(function () {
		
	return {
		init: function() {
		
		},
		
		save: function(customer_data, base_url) { 

			$('.wrap-cart-count').popover('hide');
		
			var modal = $("#modal-card-spinner").modal({
				backdrop: "static", //remove ability to close modal with click
				keyboard: false, //remove option to close with keyboard
				show: true //Display loader!
			});

			$.ajax({
				context: this,
				type: 'POST',
				dataType: 'json',
				url: base_url + 'checkout/save',
				data: { ajax: 1, customer_data: customer_data},
				async:false
			}).done(function( response ) {
	
				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				
				if (response.error == 0 ) {
					$("#modal-card-message .modal-body").html('<div class="alert alert-primary" role="alert">' + response.message + '</div>');
					this.updateMiniCart(response.qty, response.contents);
					$('.wrap-checkout .wrap-review').remove();
					$('.wrap-checkout .wrap-actions').remove();
					$('.wrap-checkout .wrap-form').html('<h4>Thank you for the order.</h4><br /><h5>Order Id: ' + response.order_id + '</h5><a href="/catalog">Continue Shopping</a>');
				}else {
					$("#modal-card-message .modal-body").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
				}	
				
				$("#modal-card-message").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});
				
				$('.wrap-checkout .btn-process').attr('disabled', false);

			});
		},
		
		updateMiniCart: function(qty, contents) {
			$('.mini-cart .cart-count').text(qty);
			$('.wrap-cart-count').attr('data-content', contents);
		}

	}
	
});