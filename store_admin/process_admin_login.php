<?php

// connect to db /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';



// user defined variables /////
$login_table = "shopcart_admin_users";


// user defined functions for process_admin_login.php page /////
function check_input ( $form_array ) {

	if ( $form_array[ 'username' ] &&
	$form_array[ 'password' ] ) {
	
		return 1;	
	
	}
	else return 0;
}


// body ////

if ( check_input( $_POST ) ) { 
	$adminUserName = $_POST['username'];
	$adminPassword = $_POST['password'];

	echo "Username passed: ".$adminUserName;

	//$theSQL = "SELECT * from ".$login_table." where username = ".$adminUserName." and password = ".$adminPassword;
	//$theSQL = "SELECT * FROM '".$login_table. "' WHERE username = ".$adminUserName." AND password = ".$adminPassword;
	//$theSQL = "select * from ".$login_table." where username=".$adminUserName;

	$theSQL = "SELECT username, email_address FROM ".$login_table." WHERE username = '" . mysql_real_escape_string($adminUserName) . "' AND password = '" .  mysql_real_escape_string($adminPassword) . "' LIMIT 1";
	
	//$theSQL = "select * from ".$login_table;
	if ( $theQueryResult = $db->query($theSQL) ) {

		if ( $data = $theQueryResult->fetch_object() ) {
			//echo $data->username.": ";
			//echo $data->email_address."<br>";
			$_SESSION['username'] = $data->username;
			//$_SESSION['loggedIn'] = "yes";
			header("Location: admin_orders.php");			
		}
		else {
			header("Location: admin_login.php");	
		}
		
		$theQueryResult->free();		

	}

	else {
		//trigger_error("FAILED! the SQLs say:", mysql_error() );
		print "FAILED! Something went wrong somewhere. This hint may help: ".$db->error;
	}
	$db->close();
	
	
	
}
else {
	echo "Please enter a Username and Password.";
}



?>
