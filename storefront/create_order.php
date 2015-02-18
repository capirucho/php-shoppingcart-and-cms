<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'shopcart_order_details';
	$productsTable = 'shopcart_products';
	$ordersTable = 'shopcart_orders';
	$currentUserSessionId = session_id();

	if ( isset($_GET['custId']) || isset($_SESSION['customerId']) ) {

		if ( isset($_GET['custId']) ) {
			$customerId = $_GET['custId'];
		} 

		if ( isset($_SESSION['customerId']) ) {
			$customerId = $_SESSION['customerId'];
		}
		


		$cartItemsQuery = "select quantity, unit_price, session_id, product_id from ".$cartTable." where session_id = '".$currentUserSessionId."' and checkout_status = 'incomplete';";			

		echo $cartItemsQuery."<br><br>";

		//the results from the queries
		$resultsForItemsInCart = $db->query($cartItemsQuery);

		$cartSubTotal = 0;

		while ( $data = $resultsForItemsInCart->fetch_object() ) {

			$item_total = $data->unit_price * $data->quantity;
			$item_total = number_format($item_total, 2);
			$cartSubTotal = $cartSubTotal + $item_total;
			
			echo "item total: ".$item_total."<br>";

			echo "items cart subtotal before insert to orders table: ".$cartSubTotal."<br>";

		}
		$resultsForItemsInCart->free();

		$createOrderQuery = "insert into ".$ordersTable." values ('', default, '".$customerId."', now(), '".$cartSubTotal."', default, default, default);";


		$total = 0;

		if ($db->query($createOrderQuery) ) {
			$orderId = $db->insert_id;
			$_SESSION['sessionOrderID'] = $orderId;

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

					$finalizeOrderQuery = "update ".$ordersTable." set total = ".$total." where order_id = ".$officialOrderId.";";


					if ( $db->query($finalizeOrderQuery ) ) {
						$updateOrderDetailQuery = "update ".$cartTable." set order_id = ".$officialOrderId." where session_id = '".$currentUserSessionId."';";
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
		$queryOrdersTableResults->free();
		
	}


?>