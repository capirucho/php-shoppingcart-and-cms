<?php
	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';

	if ( isset($_POST['pid'] ) && isset($_POST['quantity'] ) && isset($_POST['unitprice'] ) && isset($_POST['prodname'] ) )  {
		$productAdded = $db->real_escape_string( $_POST['pid'] );
		$productName = $db->real_escape_string( $_POST['prodname'] );
		$quantity = $db->real_escape_string( $_POST['quantity'] );
		$price = $db->real_escape_string( $_POST['unitprice']);
		$userSessionId = session_id(); 
		$cartTable = "shopcart_order_details";

		$addToCartQuery = "INSERT INTO ".$cartTable." VALUES ('','".$userSessionId."', '".$productAdded."', '".$productName."', '".$price."', '".$quantity."', now(), default, default);";

		if ($db->query($addToCartQuery)) {
			$message = "Added to Cart!";
			header("Location: show_cart.php?addedToCart=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

	 
	}


?>