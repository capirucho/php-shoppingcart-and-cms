<?php

	// connect to db /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'cart';
	$productsTable = 'products';
	$ordersTable = 'orders';
	$orderDetailsTable = 'cart';
	$currentUserSessionId = session_id();

	if ( isset($_GET['custId']) ) {
		$customerId = $_GET['custId'];

		$cartItemsQuery = "select sum(quantity) as quantity, price, session_id, ".$cartTable.".product_id from ".$productsTable." 
		left outer join ".$cartTable." on ".$cartTable.".product_id = ".$productsTable.".product_id where ".$cartTable.".session_id = '".$currentUserSessionId."' and 
		".$cartTable.".checkout_status = 'incomplete' GROUP BY session_id;";	

		echo "boing:".$cartItemsQuery;	

		//the results from the queries
		$resultsForItemsInCart = $db->query($cartItemsQuery);

		$cartSubTotal = 0;

		while ( $data = $resultsForItemsInCart->fetch_object() ) {

			$item_total = $data->price * $data->quantity;
			$item_total = $item_total;
			$cartSubTotal = $cartSubTotal + $item_total;

			echo "<br><br>subtotal: ".number_format($cartSubTotal, 2)."<br><br>";

		}

		$createOrderQuery = "INSERT INTO ".$ordersTable." VALUES ('', default, '".$customerId."', now(), '".$cartSubTotal."', default, default, default);";


		$total = 0;

		if ($db->query($createOrderQuery) ) {
			$orderId = $db->insert_id;

			$queryOrdersTable = "select order_id, sub_total, tax, delivery_charge from ".$ordersTable." where order_id =".$orderId.";";
			if ($queryOrdersTableResults = $db->query($queryOrdersTable) ) {
				if ( $data = $queryOrdersTableResults->fetch_object() ) {
					$officialOrderId = $data->order_id;
					$orderSubTotal = $data->sub_total;
					$tax = $data->tax;
					$deliveryCharge = $data->delivery_charge;

					$total = $orderSubTotal + ($orderSubTotal * $tax);
					$total = $total + $deliveryCharge;

					echo "the final total =".$total."<br><br>";

					//set order status complete after user has "placed order"
					//NOTE: may need to use timestamp on cart to uniquely identify shopping session after an order is place but user buys
					//more after placing original order ????? maybe ?????? or find a way to "destroy current session" after placing order (but
					//without logging out user if logged in..sigh)
					//$finalizeOrderQuery = "UPDATE ".$ordersTable." SET total = ".$total.", order_status = 'complete' WHERE order_id = ".$officialOrderId.";";
					$finalizeOrderQuery = "UPDATE ".$ordersTable." SET total = ".$total." WHERE order_id = ".$officialOrderId.";";

					$db->query($finalizeOrderQuery);

					echo $finalizeOrderQuery;

				} else {
					echo "<p>Binggg:MySQL error no {$db->errno} : {$db->error}</p>";
				}

			} else {
				echo "<p>Boo:MySQL error no {$db->errno} : {$db->error}</p>";
			}


		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

		$updateOrderDetailQuery = "UPDATE ".$orderDetailsTable." SET order_id = ".$officialOrderId.", checkout_status = 'complete' WHERE session_id = ".$currentUserSessionId.";";

		$db->query($updateOrderDetailQuery);

		
	}


?>