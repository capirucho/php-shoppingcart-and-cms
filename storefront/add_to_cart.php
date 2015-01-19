<?php

	require 'shoppingcart_config.php';

	if ( isset($_POST['pid']) && isset($_POST['quantity'] ) )  {
		$productAdded = $db->real_escape_string( $_POST['pid'] );
		$quantity = $db->real_escape_string( $_POST['quantity'] );
		$userSessionId = session_id(); 
		//echo $userSessionId;
		$table_name = "cart";

		$addToCartQuery = "INSERT INTO ".$table_name." VALUES ('','".$userSessionId."', '".$productAdded."', '".$quantity."', now(), default, default);";

		if ($db->query($addToCartQuery)) {
			$message = "Added to Cart!";
			header("Location: show_cart.php?addedToCart=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

	 
	}


?>