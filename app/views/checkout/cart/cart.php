<div class="container">
	<div class="row wrap-cart">
		
		<div class="col-md-12">
			<h3 class="page-title">Shopping Cart</h3>
		</div>
		
		<?php if (!empty($cartItems)):?>
			<div class="col-md-12 wrap-table">
				<table class="table table-products">
					<thead>
						<tr>
							<th scope="col">Product Image</th>
							<th scope="col">Product Name</th>
							<th class="text-center" scope="col">Qty.</th>
							<th class="text-center" scope="col">Price</th>
							<th class="text-center" scope="col">Subtotal</th>
							<th class="text-center" scope="col">&nbsp;</th>
						</tr>
					</thead>
					
					<tbody>
						<?php foreach ($cartItems as $id => $item): ?>
							<tr class="row-id-<?php echo $id ?> row-product">
								<td class="product-image"><img src="/media/products/<?php echo $item['image'] ?>" /></td>
								<td><a href="/products/<?php echo $item['handle']?>"><?php echo $item['name'] ?></a></td>
								<td class="text-center"><input type="number" data-product-price="<?php echo (int) $item['price'] ?>" class="form-control input-qty" min="0" value="<?php echo $item['qty'] ?>"></td>
								<td class="text-center"><?php echo '$' . (int) $item['price'] ?></td>
								<td class="text-center"><?php echo '$<span class="subtotal">' . $item['qty'] * (int) $item['price'] . '</span>' ?></td>
								<td><i data-product-id="<?php echo $id?>" class="fas fa-trash-alt"></i></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
					
					<tfoot>
						<tr>
							<td colspan="6" class="text-right cart-total">Total: $<span class="total"><?php echo $total?></span></td>
						</tr>
					</tfoot>
					
				</table>
				
				<div class="col-md-12 cart-actions ">
					<div class="container">
						<div class="row">
							<div class="col-md-12 pl-0 pr-0 cart-actions text-right">
								<button type="button" class="btn btn-primary btn-update">Update</button>
								<button type="button" class="btn btn-primary btn-remove-all">Remove All</button>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">&nbsp;</div>
						</div>
						<div class="row">
							<div class="col-md-12 pl-0 pr-0 cart-actions text-right">
								<a href="/checkout" class="btn btn-success btn-lg btn-checkout" role="button" aria-pressed="true">Ckeckout</a>
							</div>
						</div>
					</div>
					
				</div>
				
			</div>
		<?php else:?>
			<div class="col-md-12">
				The shopping cart is empty.
			</div>
		<?php endif;?>
		
	</div>
</div>

<?php echo $modals ?>