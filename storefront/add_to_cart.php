<?php

	require 'shoppingcart_config.php';

	if ( isset($_POST['pid']) && isset($_POST['quantity'] ) )  {
		$productAdded = $db->real_escape_string( $_POST['pid'] );
		$quantity = $db->real_escape_string( $_POST['quantity'] );
		$userSessionId = session_id(); 
		//echo $userSessionId;
		$table_name = "cart";

		$addToCartQuery = "INSERT INTO ".$table_name." VALUES ('','".$userSessionId."', '".$productAdded."', '".$quantity."', now());";

		if ($db->query($addToCartQuery)) {
			$message = "Added to Cart!";
			header("Location: show_cart.php?userAdded=$message");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}

	 
	}


?>