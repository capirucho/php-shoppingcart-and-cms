<?php

	require 'shoppingcart_config.php';
	$userSessionId = session_id();

	if ( isset($_GET['edit'])) {
		$productAdded = $db->real_escape_string( $_GET['pid'] );
		$quantity = $db->real_escape_string( $_POST['quantity'] );
		 
		//echo $userSessionId;
		$table_name = "cart";

		$addToCartQuery = "INSERT INTO ".$table_name." VALUES ('','".$userSessionId."', '".$productAdded."', '".$quantity."', now());";

		if ($db->query($addToCartQuery)) {
			$message = "Added to Cart!";
			header("Location: show_cart.php?addedToCart=$message");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}

	 
	}


	if ( isset($_GET['delete']))  {
		$cartItemToDelete = $db->real_escape_string( $_GET['delete'] );
		//$quantity = $db->real_escape_string( $_POST['quantity'] ); 
		//echo $userSessionId;
		$table_name = "cart";

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