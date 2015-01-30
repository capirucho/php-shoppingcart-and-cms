<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'shopcart_order_details';
	$ordersTable = 'shopcart_orders';
	$currentUserSessionId = session_id();

	if ( isset($_POST['orderId']) ) {
		$orderId = $_POST['orderId'];
		$updateOrderDetailsStatusQuery = "UPDATE ".$cartTable." SET checkout_status = 'complete' WHERE order_id = ".$orderId.";";
		if ( $db->query($updateOrderDetailsStatusQuery) ) {
						$updateOrderQuery = "UPDATE ".$ordersTable." SET order_status = 'complete' WHERE order_id = ".$orderId.";";
						if ( $db->query($updateOrderQuery) ) {
							unset($_SESSION['cart_items']);
							unset($_SESSION['sessionOrderID']);

							if (ini_get("session.use_cookies")) {
							    $params = session_get_cookie_params();
							    setcookie(session_name(), '', time() - 42000,
							        $params["path"], $params["domain"],
							        $params["secure"], $params["httponly"]
							    );
							}

							session_regenerate_id();
							//session_regenerate_id(true);
							header ("Location: home.php?message=complete");
						}

		}
	}



?>