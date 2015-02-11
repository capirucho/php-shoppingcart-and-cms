<?php

// connect to db and application commonly used functions /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';



// user defined variables /////
$login_table = "shopcart_customer";


// user defined functions for process_admin_login.php page /////
function check_input ( $form_array ) {

	if ( $form_array[ 'username' ] && $form_array[ 'password' ] ) {
	
		return 1;	
	
	}
	else return 0;
}


// body ////

if ( check_input( $_POST ) ) { 
	$adminUserName = $_POST['username'];
	$adminPassword = $_POST['password'];
	$placeOrder = $_POST['placeorder'];

	$theSQL = "SELECT customer_id, username, email_address FROM ".$login_table." WHERE username = '" . mysql_real_escape_string($adminUserName) . "' AND password = '" .  mysql_real_escape_string($adminPassword) . "' LIMIT 1";
	
	if ( $theQueryResult = $db->query($theSQL) ) {

		if ( $data = $theQueryResult->fetch_object() ) {
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
		else {
			header("Location: customer_login.php");	
		}
		
		$theQueryResult->free();		

	}

	else {
		print "FAILED! Something went wrong somewhere. This hint may help: ".$db->error;
	}
	$db->close();
	
	
	
}
else {
	echo "Please enter a Username and Password.";
}



?>
