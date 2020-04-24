<div class="container wrap-checkout">
	<div class="row">
		
		<div class="col-md-12">
			<h3 class="page-title">Checkout</h3>
		</div>
		
		<div class="col-md-12 wrap-form">
			<form id="checkoutForm" method="post">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputFirstName">First Name</label><span class="required-mark">*</span>
						<input type="text" maxlength="50" name="first_name" class="form-control" id="inputFirstName" required />
					</div>
					<div class="form-group col-md-6">
						<label for="inputLastName">Last Name</label><span class="required-mark">*</span>
						<input type="text" maxlength="50" name="last_name" class="form-control" id="inputLastName" required />
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail">Email</label><span class="required-mark">*</span>
						<input type="email" maxlength="50" name="email" class="form-control" id="inputEmail" required />
					</div>
					<div class="form-group col-md-6">
						<label for="inputPhone">Phone</label><span class="required-mark">*</span>
						<input type="text" maxlength="20" name="phone" class="form-control" id="inputPhone" required />
					</div>
				</div>
				<div class="form-group">
					<label for="inputAddress">Address</label><span class="required-mark">*</span>
					<input type="text" name="address" maxlength="255" class="form-control" id="inputAddress" placeholder="1234 Main St" required />
				</div>
			  
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputCity">City</label><span class="required-mark">*</span>
						<input type="text" maxlength="50" name="city" class="form-control" id="inputCity" required />
					</div>
					<div class="form-group col-md-6">
						<label for="inputState">State</label><span class="required-mark">*</span>
						<input type="text" maxlength="50" name="state" class="form-control" id="inputState" required />
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputZipcode">Zipcode</label>
						<input type="text" maxlength="15" name="zipcode" class="form-control" id="inputZipcode" />
					</div>
					<div class="form-group col-md-6">
						<label for="inputCountry">Country</label><span class="required-mark">*</span>
						<select class="custom-select" name="country" id="inputCountry" required>
							<option selected value="">Choose...</option>
							<option value="USA">USA</option>
							<option value="Russia">Russia</option>
							<option value="Englend">Englend</option>
						</select>
					</div>
				</div>
				
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputDate">Delivery Date</label>
						<input type="date" name="delivery_date" max="3000-12-31" min="<?php echo date('Y-m-d', time())?>" id="inputDate" class="form-control" />
					</div>
					<div class="form-group col-md-6">
						<label for="inputState">Time</label>
						<input type="text" maxlength="50" name="delivery_time" class="form-control" id="inputTime" />
					</div>
				</div>
				
			</form>
		</div>
		
		<div class="col-md-12">
			&nbsp;
		</div>
		
		<div class="col-md-12 wrap-review">
			<?php echo $review;?>
		</div>
		
		<div class="col-md-12 wrap-actions text-right">
			<button type="submit" form="checkoutForm" class="btn btn-process btn-lg btn-primary">Process Checkout</button>
		</div>
		
	</div>
</div>

<?php echo $modals?>
