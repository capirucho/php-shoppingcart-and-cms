<?php

	// connect to db and application commonly used functions /////
	require 'shoppingcart_config.php';
	$userSessionId = session_id();


	if ( isset($_GET['delete']))  {
		$cartItemToDelete = $db->real_escape_string( $_GET['delete'] );
		$table_name = "shopcart_order_details";

		$deleteFromCartQuery = "delete from ".$table_name." where product_id = ".$cartItemToDelete." and session_id ='".$userSessionId."';";

		if ($db->query($deleteFromCartQuery)) {
			$message = "Item deleted from your shopping cart!";
			header("Location: show_cart.php?deletedItem=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

	 
	}	


?>