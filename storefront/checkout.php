<?php require 'header.php'; ?>

<?php
	if ( isset($_GET['invalidEmail']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['invalidEmail']."</div>";
	}
?>
<div class="alert alert-danger hidden" role="alert">...</div>
<div class="alert alert-warning hidden" role="alert">...</div>

<?php if ( !isset($_SESSION['customer_username'] ) ) { ?>
<div class="panel panel-default">
  <div class="panel-heading step1header">
    <h3 class="panel-title">Account Details</h3>
  </div>
  <div id="step1" class="panel-body">
    <div class="row clearfix">
    	<div class="col-sm-6">
    		<h2>I'm a New Customer</h2>
    		<p>
    			Register for a faster checkout and more.
    		</p>
    		<button id="createAccount" type="button" class="btn btn-primary">Create A New Account</button>
    	</div>
    	<div class="col-sm-6">
    		<h2>I'm a Returning Customer</h2>
			<h3>Login</h3>
			<form role="form" action="process_customer_login.php" method="post">
			  <div class="form-group">
			    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
			    <input id="placeorder" name="placeorder" type="hidden" value="true">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>

    	</div>
    </div>

  </div>
</div>



<div class="panel panel-default">
  <div class="panel-heading step2header">
    <h3 class="panel-title">Register</h3>
  </div>
  <div id="step2" class="panel-body hidden">
		<form id="register-form" role="form" action="add_customer_info.php" method="POST">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label class="control-label" for="first_name">First Name</label>
							    <input name="first_name" type="text" class="form-control" placeholder="First Name" id="first-name" value="">
							  </div>
							</div>
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label class="control-label" for="last_name">Last Name</label>
							    <input name="last_name" type="text" class="form-control" placeholder="Last Name" id="last-name" value="">
							  </div>
							</div>
					</div>

					  <div class="form-group">
					    <label class="control-label" for="email_address">Email Address</label>
					    <input name="email_address" type="text" class="form-control" placeholder="Enter Email" id="email-address" value="">
					  </div>			  
					  <div class="form-group">
					    <label class="control-label" for="username">Username</label>
					    <input name="username" type="text" class="form-control" placeholder="Username" id="customerLoginName" value="">
					  </div>  		  		  		  
					  <div class="form-group">
					    <label class="control-label" for="password">Password</label>
					    <input name="password" type="text" class="form-control" placeholder="Password" id="customerPassword" value="">
					  </div>

					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label class="control-label" for="credit_card_type">Credit Card</label>
									<select name="credit_card_type" size="1" class="form-control" id="credit-card-type" value="">
										<option value="" selected>Select type of Credit Card</option>
										<option value="visa">Visa</option>
										<option value="mastercard">Mastercard</option>
										<option value="amex">American Express</option>
										<option value="discover">Discover</option>
									</select>
							  </div>
						</div>
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label class="control-label" for="credit_card_number">CC Number</label>
							    <input name="credit_card_number" type="text" class="form-control" id="credit-card-number" placeholder="Credit Card Number" value="">
							  </div>
							</div>
					</div>
					  <div class="form-group">
					    <label class="control-label" for="credit_card_expiration_date">Expiration Date</label>
					    <input name="credit_card_expiration_date" type="text" class="form-control" id="credit-card-expiration-date" placeholder="dd/mm/yyyy" value="">
					  </div> 					

				</div>


				<div class="col-sm-6">
				  <div class="form-group">
				    <label class="control-label" for="phone">Phone Number</label>
				    <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone Number" value="">
				  </div>
				  <div class="form-group">
				    <label class="control-label" for="address">Address</label>
				    <input name="address" type="text" class="form-control" id="address" placeholder="Address" value="">
				  </div>
				  <div class="form-group">
				    <label class="control-label" for="city">City</label>
				    <input name="city" type="text" class="form-control" id="city" placeholder="City" value="">
				  </div>		  		  		  
				  <div class="form-group">
				    <label class="control-label" for="state">State</label>
				    <select name="state" size="1" class="form-control" id="state">
				    	<option value="" selected> -- select state --</option>
						<option value="AL">Alabama</option>
						<option value="AK">Alaska</option>
						<option value="AZ">Arizona</option>
						<option value="AR">Arkansas</option>

						<option value="CA">California</option>
						<option value="CO">Colorado</option>
						<option value="CT">Connecticut</option>
						<option value="DE">Delaware</option>

						<option value="DC">Dist of Columbia</option>
						<option value="FL">Florida</option>
						<option value="GA">Georgia</option>
						<option value="HI">Hawaii</option>

						<option value="ID">Idaho</option>
						<option value="IL">Illinois</option>
						<option value="IN">Indiana</option>
						<option value="IA">Iowa</option>

						<option value="KS">Kansas</option>
						<option value="KY">Kentucky</option>
						<option value="LA">Louisiana</option>
						<option value="ME">Maine</option>

						<option value="MD">Maryland</option>
						<option value="MA">Massachusetts</option>
						<option value="MI">Michigan</option>
						<option value="MN">Minnesota</option>

						<option value="MS">Mississippi</option>
						<option value="MO">Missouri</option>
						<option value="MT">Montana</option>
						<option value="NE">Nebraska</option>

						<option value="NV">Nevada</option>
						<option value="NH">New Hampshire</option>
						<option value="NJ">New Jersey</option>
						<option value="NM">New Mexico</option>

						<option value="NY">New York</option>
						<option value="NC">North Carolina</option>
						<option value="ND">North Dakota</option>
						<option value="OH">Ohio</option>

						<option value="OK">Oklahoma</option>
						<option value="OR">Oregon</option>
						<option value="PA">Pennsylvania</option>
						<option value="RI">Rhode Island</option>

						<option value="SC">South Carolina</option>
						<option value="SD">South Dakota</option>
						<option value="TN">Tennessee</option>
						<option value="TX">Texas</option>

						<option value="UT">Utah</option>
						<option value="VT">Vermont</option>
						<option value="VA">Virginia</option>
						<option value="WA">Washington</option>

						<option value="WV">West Virginia</option>
						<option value="WI">Wisconsin</option>
						<option value="WY">Wyoming</option>
					</select>
				  </div>
				  <div class="form-group">
				    <label class="control-label" for="zipcode">Zip Code</label>
				    <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="Enter zipcode" value="">
				  </div>
				</div>				
		  </div>		  
		  <button id="register-btn" type="submit" class="btn btn-success">Register</button>
		</form>
  </div>
</div>

<?php } ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Place order</h3>
	</div>
	<?php 
		if ( isset( $_GET['orderId'] ) || isset($_SESSION['sessionOrderID'] ) )  { 
			if ( isset($_GET['orderId'] ) ) {
				$orderId = $_GET['orderId']; 
			} 
			else {
				$orderId = $_SESSION['sessionOrderID'];
			}
	?>
	<div id="step3" class="panel-body place-order">
	<?php

		//tables to query
		$ordersTable = "shopcart_orders";
		$orderDetailsTable = "shopcart_order_details";



		//the queries: get products ordered from order details table, get totals
		$orderItemsQuery = "select product_name, sum(quantity) as quantity, unit_price from ".$orderDetailsTable." where order_id = ".$orderId." GROUP BY product_name;";
		$orderTotalsQuery = "select order_id, sub_total, tax, delivery_charge, total from ".$ordersTable." where order_id =".$orderId.";";

		//the results from the queries
		$resultsForOrderItemsQuery = $db->query($orderItemsQuery);
		$resultsForOrderTotalsQuery = $db->query($orderTotalsQuery);

	?>


	<?php while ( $dataForOrderItems = $resultsForOrderItemsQuery->fetch_object() ) { ?>

		<div class="row cart-item clearfix">
			<div class="col-md-6">
				<h3><?php echo $dataForOrderItems->product_name; ?></h3>
				price per dozen: <?php echo $dataForOrderItems->unit_price; ?><br>
				Current amount: <strong><?php echo $dataForOrderItems->quantity; ?> dozen</strong>
			</div>
			<div class="col-md-6 checkout item-total pull-right">
				<?php 
					$item_total = $dataForOrderItems->unit_price * $dataForOrderItems->quantity;
					$item_total = number_format($item_total, 2);
					echo "$".$item_total;
				?>					
			</div>
		</div>

	<?php
	 	} //end while loop 
	 	$resultsForOrderItemsQuery->free();
	?>
		<div class="row total">
			<div class="panel panel-info">
			  <div class="panel-heading">
			    <h3 class="panel-title">Today's Charges: </h3>
			  </div>
				<div class="panel-body">
					<?php 
						if ( $dataForOrderTotals = $resultsForOrderTotalsQuery->fetch_object() ) { 
						$orderSubTotal = $dataForOrderTotals->sub_total;
						$deliveryCharge = $dataForOrderTotals->delivery_charge;
						$officialOrderId = $dataForOrderTotals->order_id;
						$taxRate = $dataForOrderTotals->tax;
						$total = $dataForOrderTotals->total;
						$taxCharges = $orderSubTotal * $taxRate;
					?>
					
				    Subtotal: <span class="amount"><?php echo "$".number_format($orderSubTotal, 2); ?></span><br>
				    Taxes: <span class="amount"><?php echo "$".number_format($taxCharges, 2); ?></span><br>
				    Delivery charge: <span class="amount"><?php echo "$".number_format($deliveryCharge, 2); ?></span><br>		    
				    Total: <span class="amount"><?php echo "$".number_format($total, 2); ?></span><br><br><br>
				    <form action="complete_order.php" method="post">
				      	<?php if ( $total > 0 ) { ?>
				      	<input name="orderId" type="hidden" value="<?php echo $officialOrderId ?>">
				    	<button type="submit" class="btn btn-success">Place Order</button>
				    	<?php } ?>
				    </form>
				    <?php 
						} //end if 
						$resultsForOrderTotalsQuery->free();
					?>
				</div>
			</div>		
		</div>
	</div>		
</div>
<?php } ?>



<?php require 'footer.php'; ?>

















