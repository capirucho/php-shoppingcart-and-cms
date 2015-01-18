

<?php

	// connect to db /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';



	// user defined variables /////
	$customerTable = "customer";

	function check_input ( $form_array ) {

		if ( $form_array[ 'first_name' ] && $form_array[ 'last_name' ] && $form_array[ 'email_address' ] 
			&& $form_array['username'] && $form_array['password'] && $form_array['credit_card_type'] 
			&& $form_array['credit_card_number'] && $form_array['credit_card_expiration_date'] && $form_array['phone'] 
			&& $form_array['address'] && $form_array['city'] && $form_array['state'] && $form_array['zipcode']) {
		
			return 1;			
		}

		else return 0;
	}

	// Main Body  /////

	if ( check_input( $_POST ) ) {
		$firstName = $db->real_escape_string( $_POST['first_name'] );
		$lastName = $db->real_escape_string( $_POST['last_name'] );
		$emailAddress = $db->real_escape_string( $_POST['email_address'] );
		$username = $db->real_escape_string( $_POST['username'] );
		$password = $db->real_escape_string( $_POST['password'] );
		$ccType = $db->real_escape_string( $_POST['credit_card_type'] );
		$ccNumber = $db->real_escape_string( $_POST['credit_card_number'] );
		//$ccExpDate = $db->real_escape_string( $_POST['credit_card_expiration_date'] );
		$ccExpDate = date ('Y-m-d', strtotime($_POST['credit_card_expiration_date']));
		$phone = $db->real_escape_string( $_POST['phone'] );
		$address = $db->real_escape_string( $_POST['address'] );
		$city = $db->real_escape_string( $_POST['city'] );
		$state = $db->real_escape_string( $_POST['state'] );
		$zipcode = $db->real_escape_string( $_POST['zipcode'] );

		# check if customer username name exist
		$userNameExists = 0;
		$theSQL = "SELECT username FROM ".$customerTable." WHERE username = '" . $username . "' LIMIT 1";

		if ($theQueryResult = $db->query($theSQL) ) {
	
			if ( $data = $theQueryResult->fetch_object() ) {
				$userNameExists = 1;	

				if ($userNameExists == 1) {
					$message = "Username Name already exists! Please choose a different Username";
					header("Location: checkout.php?userNameExists=$message");
					exit();
				}			
			}
		}


		# insert customer info data into mysql database

		$insertCustomerQuery = "INSERT INTO ".$customerTable." VALUES ('','".$firstName."', '".$lastName."', '".$emailAddress."', '".$username."', '".$password."', '".$phone."', '".$address."', '".$city."', '".$state."', '".$zipcode."', '".$ccType."', '".$ccNumber."', '".$ccExpDate."');";

		//$insertProdQuery = "INSERT INTO ".$table_name." VALUES ('','".$catId."', now(), '".$prodName."', '".$prodImage."', '".$prodDescription."', 
					//'".$price."');";

		if ($db->query($insertCustomerQuery)) {
			//echo "New Record has id ".$mysqli->insert_id;
			$customerId = $db->insert_id;

			//query customer table to get customer username so that we can set _session username
			$queryCustomerTable = "select username from ".$customerTable." where customer_id = ".$customerId.";";
			if ($customerTableResults = $db->query($queryCustomerTable)) {
				if ( $data = $customerTableResults->fetch_object() ) {
					$_SESSION['customer_username'] = $data->username;
					header("Location: create_order.php?custId=$customerId");
					//header("Location: home.php");
				}
			} else {
				echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			}

			//$message = "Hi ".$_SESSION['customer_username']." you have been registered!";
			//header("Location: create_order.php?registrationSuccess=$message&custId=$customerId");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}


	}

	else {

		echo "Please fill in all fields.";
	}

?>

