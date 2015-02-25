<?php

// connect to db and application commonly used functions /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';

// user defined variables /////
$customerTable = "shopcart_customer";


// user defined functions for process_admin_login.php page /////
function check_input ( $form_array ) {

	if ( $form_array[ 'username' ] && $form_array[ 'password' ] ) {
	
		return 1;	
	
	}
	else return 0;
}


// body ////

if ( check_input( $_POST ) ) { 
	$customerUsername = $db->real_escape_string($_POST['username']);
	$customerPassword = $db->real_escape_string($_POST['password']);
	$placeOrder = $_POST['placeorder'];

	$customerTableQuery = "select customer_id, username, password, email_address, verified_email from ".$customerTable." where username = '".$customerUsername."' and password = '".$customerPassword."' LIMIT 1";
	
	if ( $customerTableQueryResults = $db->query($customerTableQuery) ) {
		if ( $data = $customerTableQueryResults->fetch_object() ) {
			if ( $data->verified_email == 1 ) {
				$customerId = $data->customer_id;
				$_SESSION['customer_username'] = $data->username;
				$_SESSION['customerId'] = $data->customer_id;
				if ( $placeOrder == true ) {
					header("Location: create_order.php?custId=$customerId");		
				}
				else {
					header("Location: home.php");
				}
			}
			if ( $data->verified_email == 0 ) { 
				$message = "You have not activated your account. Please check your email and follow directions to activate your account.";
				header("Location: customer_login.php?needToVerify=$message");
			}
					
		}
		else {
			if ($data->username != $customerUsername || $data->password != $customerPassword ) {
				$message = "Incorrect username or password entered";
				header("Location: customer_login.php?incorrectLogin=$message");	
			}	
		}
		$customerTableQueryResults->free();		
	}

	else {
		echo "FAILED! Something went wrong somewhere. This hint may help: ".$db->error;
	}
	
		
	
}
else {
	$message = "Please enter a Username and Password.";
	header("Location: customer_login.php?noBlanks=$message");	
}

$db->close();

?>
