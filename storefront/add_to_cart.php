<?php
	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';

	if ( isset($_POST['pid'] ) && isset($_POST['quantity'] ) && isset($_POST['unitprice'] ) && isset($_POST['prodname'] ) )  {
		$productId = $db->real_escape_string( $_POST['pid'] );
		$productName = $db->real_escape_string( $_POST['prodname'] );
		$quantity = $db->real_escape_string( $_POST['quantity'] );
		$price = $db->real_escape_string( $_POST['unitprice']);
		$userSessionId = session_id(); 
		$cartTable = "shopcart_order_details";

	}



	if( !isset($_SESSION['cart_items'] ) ) {
		$_SESSION['cart_items'] = array();
	}		

	if ( array_key_exists ($productId, $_SESSION['cart_items'] ) ) {
		header("Location: home.php?message=exists&id=".$productId."&prodName=".$productName);	
	}

	else {
		$_SESSION['cart_items'][$productId] = $productName;
		$addToCartQuery = "insert into ".$cartTable." values ('','".$userSessionId."', '".$productId."', '".$productName."', '".$price."', '".$quantity."', now(), default, default);";
		if ($db->query($addToCartQuery)) {
			header("Location: home.php?message=added&prodName=".$productName);
		}
		else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

	}



?>