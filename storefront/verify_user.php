<?php

// connect to db and application commonly used function /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';



// user defined variables /////
$customerTable = "shopcart_customer";


if(isset($_GET['verifyEmail']) && !empty($_GET['verifyEmail']) AND isset($_GET['hash']) && !empty($_GET['hash']) ) {
	$verifyEmail = $db->real_escape_string($_GET['verifyEmail']);
	$verifyHash = $db->real_escape_string($_GET['hash']);
	
	$queryCustomerTableForEmailAndHash = "select email_address, hash from ".$customerTable." where email_address = '".$verifyEmail."' and hash = '".$verifyHash."';";
	
	$resultsCustomerTableEmailAndHash = $db->query($queryCustomerTableForEmailAndHash);

	if ($resultsCustomerTableEmailAndHash->num_rows > 0) {
		$updateCustomerTableQuery = "update ".$customerTable." set verified_email = 1 where email_address = '".$verifyEmail."' and hash = '".$verifyHash."';";
		if ( $db->query($updateCustomerTableQuery) ) {
			$message = "Your account has been activated. You may now login!";
			header("Location: customer_login.php?successfulVerification=$message");

			//query customer table to get customer username so that we can set _session username
			//Also set customerId in the session in case logged-in user continues shopping after placing an order
			/*
			$queryCustomerTable = "select customer_id, username from ".$customerTable." where customer_id = ".$customerId.";";
			if ($customerTableResults = $db->query($queryCustomerTable)) {
				if ( $data = $customerTableResults->fetch_object() ) {
					$_SESSION['customer_username'] = $data->username;
					$_SESSION['customerId'] = $data->customer_id;
					header("Location: create_order.php?custId=$customerId");
				}
			} else {
				echo "<p>MySQL error no ".$db->errno." : ".$db->error;
			}
			*/

		}
		else {
			echo $db->errno." : ".$db->error;
		}

	}
}





?>
