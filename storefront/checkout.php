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
      - checkout_status on cart table to complete
      - if place order - set order status on order table to complete (place_order.php)
      - redirect user to sucess.php
 
- sucsess.php
 - show user sucess message order was placed


-->


		<form role="form" action="add_customer_info.php" method="POST">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="userName">First Name</label>
							    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username (this will be your login name)">
							  </div>
							</div>
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="firstName">Last Name</label>
							    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
							  </div>
							</div>
					</div>

					  <div class="form-group">
					    <label for="lastName">Email Address</label>
					    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
					  </div>			  
					  <div class="form-group">
					    <label for="UserEmail">Username</label>
					    <input name="email_address" type="email" class="form-control" id="email_address" placeholder="Enter email">
					  </div>  		  		  		  
					  <div class="form-group">
					    <label for="exampleInputPassword1">Password</label>
					    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
					  </div>

					<div class="row">
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="userName">Credit Card</label>
							    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username (this will be your login name)">
							  </div>
						</div>
						<div class="col-xs-6 col-sm-6">
							  <div class="form-group">
							    <label for="firstName">CC Number</label>
							    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
							  </div>
							</div>
					</div>
					  <div class="form-group">
					    <label for="UserEmail">Expiration Date</label>
					    <input name="email_address" type="email" class="form-control" id="email_address" placeholder="Enter email">
					  </div> 					

				</div>


				<div class="col-sm-6">
				  <div class="form-group">
				    <label for="userName">Phone Number</label>
				    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username (this will be your login name)">
				  </div>
				  <div class="form-group">
				    <label for="firstName">Address</label>
				    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
				  </div>
				  <div class="form-group">
				    <label for="lastName">City</label>
				    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
				  </div>		  		  		  
				  <div class="form-group">
				    <label for="lastName">State</label>
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
				    <label for="UserEmail">Zip Code</label>
				    <input name="email_address" type="email" class="form-control" id="email_address" placeholder="Enter email">
				  </div>
				</div>				
		  </div>		  
		  <button type="submit" class="btn btn-success">Register</button>
		</form>



<?php require 'footer.php'; ?>

















