<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'shopcart_order_details';
	$currentUserSessionId = session_id();

	if ( isset($_POST['qty']) && isset($_POST['prodId'] ) ) {
		$updatedQty = $_POST['qty'];
		$productId = $_POST['prodId'];
		$updateOrderDetailsQtyQuery = "update ".$cartTable." set quantity = ".$updatedQty." where product_id = ".$productId." and session_id = '".$currentUserSessionId."';";
		if ( $db->query($updateOrderDetailsQtyQuery) ) {
			$msgTxt = "Succesfully updated your cart.";
			header ("Location: show_cart.php?message=updated&msgTxt=".$msgTxt);
		}
		else {
			echo "<p> MySQL error no {$db->errno} : {$db->error}</p>";
		}

	}



?>