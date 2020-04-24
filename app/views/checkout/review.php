<div class="col-md-12 pl-0 pr-0">
	<h5 class="page-title">Cart Review</h5>
</div>

<?php if (!empty($cartItems)):?>
	<table class="table table-products">
		<thead>
			<tr>
				<th scope="col">Product Name</th>
				<th class="text-center" scope="col">Qty.</th>
				<th class="text-center" scope="col">Price</th>
				<th class="text-center" scope="col">Subtotal</th>
			</tr>
		</thead>
				
		<tbody>
			<?php foreach ($cartItems as $id => $item): ?>
				<tr class="row-id-<?php echo $id ?> row-product">
					<td><?php echo $item['name'] ?></td>
					<td class="text-center"><?php echo $item['qty'] ?></td>
					<td class="text-center"><?php echo '$' . (int) $item['price'] ?></td>
					<td class="text-center"><?php echo '$<span class="subtotal">' . $item['qty'] * (int) $item['price'] . '</span>' ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
					
		<tfoot>
			<tr>
				<td colspan="4" class="text-right cart-total">Total: $<span class="total"><?php echo $total?></span></td>
			</tr>
		</tfoot>
					
	</table>

<?php endif;?>