

<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';



	// user defined variables /////
	$table_name = "shopcart_admin_users";

	function check_input ( $form_array ) {

		if ( $form_array[ 'username' ] && $form_array[ 'first_name' ] && $form_array[ 'last_name'] 
			&& $form_array['password'] && $form_array['email_address'] ) {
		
			return 1;			
		}

		else return 0;
	}

	// Main Body  /////

	if ( check_input( $_POST ) ) {

		$userName = $db->real_escape_string( $_POST['username'] );
		$firstName = $db->real_escape_string( $_POST['first_name'] );
		$lastName = $db->real_escape_string( $_POST['last_name'] );
		$password = $db->real_escape_string( $_POST['password'] );
		$email = $_POST['email_address'];

		# check if username exist insert
		$foundUserName = 0;
		$theSQL = "SELECT username FROM ".$table_name." WHERE username = '" . $userName . "' LIMIT 1";

		if ($theQueryResult = $db->query($theSQL) ) {
	
			if ( $data = $theQueryResult->fetch_object() ) {
				$foundUserName = 1;	

				if ($foundUserName == 1) {
					$message = "Username already exists! Please choose a different Username.";
					header("Location: shopcart_admin_users.php?foundUserName=$message");
					exit();
				}			
			}
		}


		# insert data into mysql database

		$addUserQuery = "INSERT INTO ".$table_name." VALUES ('".$userName."', '".$firstName."', '".$lastName."', 
					'".$password."', '".$email."');";

		if ($db->query($addUserQuery)) {
			$message = "User registered successfully!";
			header("Location: shopcart_admin_users.php?userAdded=$message");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}


	}

	else {

		echo "Please fill in all fields.";

	}

?>

