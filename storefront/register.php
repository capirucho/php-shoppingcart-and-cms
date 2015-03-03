<?php require 'header.php'; ?>

<?php
	if ( isset($_GET['invalidEmail']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['invalidEmail']."</div>";
	}

	if ( isset($_GET['userNameExists']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['userNameExists']."</div>";
	}	


?>
<div class="alert alert-danger hidden" role="alert">...</div>
<div class="alert alert-warning hidden" role="alert">...</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Register</h3>
  </div>
  <div id="step2" class="panel-body">
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

<?php require 'footer.php'; ?>