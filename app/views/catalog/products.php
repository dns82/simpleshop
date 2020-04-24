<div class="row wrap-products">
	<div class="col-md-12 section-title">
		<h2>Products</h2>
	</div>
		
	<div class="col-md-12 list-products">		
		<?php if(count($products) > 0):?>
			<?php foreach ($products as $product) : ?>
				<div class="product-item">
					<div class="product-image">
						<a href="<?php echo $current_category_url . '/products/' . $product->handle; ?>"><img src="/media/products/<?php echo $product->image; ?>" title="<?php echo $product->product_name; ?>" /></img></a>
					</div>
					<div class="product-price">$<?php echo (int) $product->price; ?></div>
					<a href="<?php echo '/products/' . $product->handle; ?>"><h4 class="product-name"><?php echo $product->product_name; ?></h4></a>
					<div class="link-add-cart">
						<a onclick="return false" data-product-id="<?php echo $product->id ?>" data-product-price="<?php echo $product->price ?>" href="#">Add to Cart</a>
					</div>
				</div>
			<?php endforeach?>
			
			<?php echo $pagination ?>
				
		<?php else: ?>
			<div>There are not any products in the category.</div>
		<?php endif; ?>
	</div>
</div>	
