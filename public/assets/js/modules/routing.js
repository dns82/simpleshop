define(
	moduleRouting = {
		
		routingResolve: function(url){
			var res = {};

			url = decodeURIComponent(url);

			if(url[0] == '/'){ url=url.substr(1) }
			if(url.match('catalog')){
				res.pageName = 'catalog';
			}
			
			if(url.match('products')){
				res.pageName = 'product';
			}
			
			if(url.match('cart')){
				res.pageName = 'cart';
			}
			
			if(url.match('checkout')){
				res.pageName = 'checkout';
			}

			return res;
		}
	}
);