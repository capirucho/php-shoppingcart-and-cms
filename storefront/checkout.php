<?php require 'header.php'; ?>

<!--
step1 : may not need to do this
capture and declare vars for all the passed POST params from cart.php <br><br>

step 2<br>
get user session to compare when customerid returnes ?????

user registration form
- send all user add_customer_info.php

add_customer_info.php
- insert user info to customer table
- pass url param : customerid (via header redirect) to create_order.php page

create_order.php
- grab customer id from add_customer_info.php page
- query cart table rows for prod, quantity, subtotal, and get items in cart flagged status =incomplete AND compare usersession id in cart table to current session id
  - if session ids match
    - use result set
      - calculate grand total (delivery charge, subtotal and tax)
      - insert (create record on orders table)
 - query order table
   - get order id
 - insert into order detail (orderid, prodid, quantity, unitprice)
- redirect to checkout page pass orderid via url param

- checkout.php
	- display to user registration success
	  - or error if user exist or something went wrong
	- show order: product, qty, subtotal, tax, delivery, grandtotal
    - place oder (button)
 - place_order.php
      - change checkout_status on cart table to complete
      - if place order - set order status on order table to complete (place_order.php)
      - redirect user to sucess.php
 
- sucsess.php
 - show user sucess message order was placed


-->

<?php if (!isset($_SESSION['customer_username'])) { ?>
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
			    <!--<label for="username">Username:</label>-->
			    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
			  </div>
			  <div class="form-group">
			    <!--<label for="password">Password</label>-->
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
		<form role="form" action="add_customer_info.php" method="POST">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="first_name">First Name</label>
							    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name">
							  </div>
							</div>
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="last_name">Last Name</label>
							    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name">
							  </div>
							</div>
					</div>

					  <div class="form-group">
					    <label for="email_address">Email Address</label>
					    <input name="email_address" type="text" class="form-control" id="email_address" placeholder="Enter Email">
					  </div>			  
					  <div class="form-group">
					    <label for="username">Username</label>
					    <input name="username" type="text" class="form-control" id="username" placeholder="Username (Used to login)">
					  </div>  		  		  		  
					  <div class="form-group">
					    <label for="password">Password</label>
					    <input name="password" type="text" class="form-control" id="password" placeholder="Password">
					  </div>

					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="credit_card_type">Credit Card</label>
									<select name="credit_card_type" size="1" class="form-control">
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
							    <label for="credit_card_number">CC Number</label>
							    <input name="credit_card_number" type="text" class="form-control" id="credit_card_number" placeholder="Credit Card Number">
							  </div>
							</div>
					</div>
					  <div class="form-group">
					    <label for="credit_card_expiration_date">Expiration Date</label>
					    <input name="credit_card_expiration_date" type="text" class="form-control" id="credit_card_expiration_date" placeholder="Expiration Date">
					  </div> 					

				</div>


				<div class="col-sm-6">
				  <div class="form-group">
				    <label for="phone">Phone Number</label>
				    <input name="phone" type="text" class="form-control" id="phone" placeholder="Phone Number">
				  </div>
				  <div class="form-group">
				    <label for="address">Address</label>
				    <input name="address" type="text" class="form-control" id="address" placeholder="Address">
				  </div>
				  <div class="form-group">
				    <label for="city">City</label>
				    <input name="city" type="text" class="form-control" id="city" placeholder="City">
				  </div>		  		  		  
				  <div class="form-group">
				    <label for="state">State</label>
				    <select name="state" size="1" class="form-control">

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
				    <label for="zipcode">Zip Code</label>
				    <input name="zipcode" type="text" class="form-control" id="zipcode" placeholder="Enter zipcode">
				  </div>
				</div>				
		  </div>		  
		  <button type="submit" class="btn btn-success">Register</button>
		</form>
  </div>
</div>

<?php } ?>
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Place order</h3>
  </div>

  <div id="step3" class="panel-body hidden">



	step 3 stuff goes here



  </div>
</div>




<?php require 'footer.php'; ?>

















