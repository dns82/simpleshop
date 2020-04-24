<div class="container">
	<div class="row wrap-product">
		<div class="col-md-7 product-image">
			<img src="/media/products/<?php echo $product->image ?>" />
		</div>
		<div class="col-md-5 product-info">
			<h2 class="product-title"><?php echo $product->product_name ?></h2>
			<div class="product-price">Price: <?php echo '$' . (int) $product->price ?></div>
			<div class="product-actions">
				<form id="productForm" method="post">
					<div class="form-group row">
						<div class="col-md-5">
							<input class="form-control" id="qty" type="number" name="qty" value="1" min="1" required />
						</div>
					</div>
					<div class="wrap-buttons">
						<button type="submit" class="btn btn-primary btn-submit" data-product-id="<?php echo $product->id ?>" data-product-price="<?php echo $product->price ?>">Add to Cart</button>
					</div>
				</form>
			</div>
			<div class="product-desc"><?php echo $product->description ?></div>
		</div>
	</div>
</div>

<?php echo $modals ?>
