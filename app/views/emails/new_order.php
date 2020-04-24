Hello, <?php echo $order->first_name ?>

<p>Thank you for your order from <?php echo $header_title ?>.</p>

<p>Your Order #<?php echo $order->id ?> (placed on <?php echo $order->created_at ?>)</p>

<strong>Shipping Information:</strong><br /><br />
Recipient: <?php echo $order->first_name ?> <?php echo $order->last_name ?><br />
Email: <?php echo $order->email ?><br />
Phone: <?php echo $order->phone ?><br />
Address: <?php echo $order->address ?><br />
City: <?php echo $order->city ?><br />
State: <?php echo $order->state ?><br />
Zipcode: <?php echo $order->zipcode ?><br />
Country: <?php echo $order->country ?><br /><br />

<strong>Delivery Information:</strong><br /><br />
Delivery Date: <?php echo $order->delivery_date ?><br />
Delivery Time: <?php echo $order->delivery_time ?><br /><br />

<strong>Order Items:</strong><br /><br />
<?php if (count($order->items) > 0):?>
	<table style="width: 100%">
		<thead>
			<tr>
				<th style="text-align: left; width: 40%">Product Name</th>
				<th style="width: 20%">Qty.</th>
				<th style="width: 20%">Price</th>
				<th style="width: 20%">Subtotal</th>
			</tr>
		</thead>
				
		<tbody>
			<?php 
				$total = 0;
				foreach ($order->items as $item): 
				$total += $item->qty * (int) $item->price;
			?>
				<tr>
					<td><?php echo $item->product_name ?></td>
					<td style="text-align:center"><?php echo $item->qty ?></td>
					<td style="text-align:center"><?php echo '$' . (int) $item->price ?></td>
					<td style="text-align:center"><?php echo '$' . $item->qty * (int) $item->price ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
					
		<tfoot>
			<tr>
				<td style="font-weight: bold; font-size: 20px; padding-top: 20px" colspan="4">Total: $<?php echo $total?></td>
			</tr>
		</tfoot>
					
	</table>

<?php endif;?>