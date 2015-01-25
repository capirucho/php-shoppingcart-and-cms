<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'shopcart_order_details';
	$productsTable = 'shopcart_products';
	$ordersTable = 'shopcart_orders';
	$currentUserSessionId = session_id();

	if ( isset($_GET['custId']) ) {
		$customerId = $_GET['custId'];

		$cartItemsQuery = "select sum(quantity) as quantity, price, session_id, ".$cartTable.".product_id from ".$productsTable." 
		left outer join ".$cartTable." on ".$cartTable.".product_id = ".$productsTable.".product_id where ".$cartTable.".session_id = '".$currentUserSessionId."' and 
		".$cartTable.".checkout_status = 'incomplete' GROUP BY session_id;";	

		
		//the results from the queries
		$resultsForItemsInCart = $db->query($cartItemsQuery);

		$cartSubTotal = 0;

		while ( $data = $resultsForItemsInCart->fetch_object() ) {

			$item_total = $data->price * $data->quantity;
			$item_total = number_format($item_total, 2);
			$cartSubTotal = $cartSubTotal + $item_total;

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
					$taxRate = $data->tax;
					$deliveryCharge = $data->delivery_charge;
					$taxCharges = $orderSubTotal * $taxRate;
					$total = $orderSubTotal + $taxCharges;
					$total = $total + $deliveryCharge;


					//Set order status complete after user has "placed order"
					//NOTE: may need to use timestamp on cart to uniquely identify shopping session after an order is placed but user buys
					//more after placing original order ????? maybe ?????? or find a way to "destroy current session" after placing order (but
					//without logging out user if logged in..sigh)

					$finalizeOrderQuery = "UPDATE ".$ordersTable." SET total = ".$total." WHERE order_id = ".$officialOrderId.";";

					
					if ( $db->query($finalizeOrderQuery ) ) {
						$updateOrderDetailQuery = "UPDATE ".$cartTable." SET order_id = ".$officialOrderId." WHERE session_id = '".$currentUserSessionId."';";
						if ( $db->query($updateOrderDetailQuery) ) {
							header("Location: checkout.php?orderId=$officialOrderId");
						}
					} else {
					echo "<p>error for update order table: MySQL error no {$db->errno} : {$db->error}</p>";
					}

				} else {
					echo "<p>Error if order table query empty. MySQL error no {$db->errno} : {$db->error}</p>";
				}

			} else {
				echo "<p>Error for order table query :MySQL error no {$db->errno} : {$db->error}</p>";
			}


		} else {
			echo "<p>Error for insert into order tables: MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}
		
	}


?>