define(function () {
		
	return {
		init: function() {
		
		},
		
		add: function(id, qty, price, base_url) { 
			
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
				url: base_url + 'cart/add',
				data: { ajax: 1, product_id: id, qty: qty},
				async:false
			}).done(function( response ) {

				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				
				if (response.error == 0 ) {
					$("#modal-card-message .modal-body").html('<div class="alert alert-primary" role="alert">' + response.message + '</div>');
					this.updateMiniCart(response.qty, response.contents);
				}else {
					$("#modal-card-message .modal-body").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
				}	
				
				$("#modal-card-message").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});

			});
		},
		
		updateMiniCart: function(qty, contents) {
			$('.mini-cart .cart-count').text(qty);
			$('.wrap-cart-count').attr('data-content', contents);
		},
		
		updateCartTotal: function(total) {
			if (total <= 1) {
				this.setEmptyCart();
			}
			$('.wrap-cart .table-products .cart-total .total').text(total);
		},
		
		setEmptyCart: function(){
			$('.wrap-cart .table-products').remove();
			$('.wrap-cart .cart-actions').remove();
			$('.wrap-cart .wrap-table').append('The shopping cart is empty.');
		},
		
		remove: function(id, base_url) {

			$('.wrap-cart-count').popover('hide');
			
			$.ajax({
				context: this,
				type: 'POST',
				dataType: 'json',
				url: base_url + 'cart/remove',
				data: { ajax: 1, product_id: id},
				async:false
			}).done(function( response ) {

				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				
				if (response.error == 0 ) {
					$('.wrap-cart .table-products tr.row-id-' + id).remove();
					this.updateCartTotal(response.total);
					$("#modal-card-message .modal-body").html('<div class="alert alert-primary" role="alert">' + response.message + '</div>');
					this.updateMiniCart(response.qty, response.contents);
				}else {
					$("#modal-card-message .modal-body").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
				}	
				
				$("#modal-card-message").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});

			});
		},
		
		clear: function(base_url) {

			$('.wrap-cart-count').popover('hide');
			
			$.ajax({
				context: this,
				type: 'POST',
				dataType: 'json',
				url: base_url + 'cart/clear',
				data: { ajax: 1},
				async:false
			}).done(function( response ) {

				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				
				if (response.error == 0 ) {
					$('.wrap-cart .table-products').remove();
					$('.wrap-cart .cart-actions').remove();
					$('.wrap-cart .wrap-table').append('The shopping cart is empty.');
					
					$("#modal-card-message .modal-body").html('<div class="alert alert-primary" role="alert">' + response.message + '</div>');
					this.updateMiniCart(response.qty, response.contents);
				}else {
					$("#modal-card-message .modal-body").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
				}	
				
				$("#modal-card-message").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});

			});
		},
		
		updateSubtotals: function() {
			$('.table-products tr.row-product').each(function(){
				var qty = parseInt($(this).find('.input-qty').val().trim());
				if (isNaN(qty)) {
					return;
				}
				
				if (qty == 0) {
					$(this).remove();
					return;
				}
				
				var price = parseInt($(this).find('.input-qty').data('productPrice'));
				if (isNaN(price)) {
					return;
				}
				
				$(this).find('.subtotal').text(qty * price);
			});
		},
		
		update: function(items, base_url) {

			$('.wrap-cart-count').popover('hide');

			$.ajax({
				context: this,
				type: 'POST',
				dataType: 'json',
				url: base_url + 'cart/update',
				data: { ajax: 1, items: items},
				async:false
			}).done(function( response ) {

				$('body').removeClass('modal-open');
				$('.modal-backdrop').remove();
				
				if (response.error == 0 ) {					
					this.updateSubtotals();
					this.updateCartTotal(response.total);
					$("#modal-card-message .modal-body").html('<div class="alert alert-primary" role="alert">' + response.message + '</div>');
					this.updateMiniCart(response.qty, response.contents);
				}else {
					$("#modal-card-message .modal-body").html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
				}	
				
				$("#modal-card-message").modal({
					backdrop: "static", //remove ability to close modal with click
					keyboard: false, //remove option to close with keyboard
					show: true //Display loader!
				});

			});
		}
	}
	
});