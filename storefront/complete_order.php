<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';

	$cartTable = 'shopcart_order_details';
	$ordersTable = 'shopcart_orders';
	$customerTable = 'shopcart_customer';
	$currentUserSessionId = session_id();

	if ( isset($_POST['orderId']) ) {
		$orderId = $_POST['orderId'];
		$updateOrderDetailsStatusQuery = "update ".$cartTable." set checkout_status = 'complete' where order_id = ".$orderId.";";
		if ( $db->query($updateOrderDetailsStatusQuery) ) {
			$updateOrderQuery = "update ".$ordersTable." set order_status = 'complete' where order_id = ".$orderId.";";
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
			
				
				$finalOrderTotalsQuery = "select * from ".$ordersTable." where order_id =".$orderId;
				$finalOrderDetailsQuery = "select * from ".$cartTable." where order_id =".$orderId;

				$finalOrderDetailsResults = $db->query($finalOrderDetailsQuery);
				$finalOrderTotalsResults = $db->query($finalOrderTotalsQuery);

				$arrayFinalOrderTotalResults = array();
				while ( $totalsRow = mysqli_fetch_assoc($finalOrderTotalsResults) ) {
				  $arrayFinalOrderTotalResults[] = $totalsRow;
				}				

				foreach ($arrayFinalOrderTotalResults as $key => $value) {
					$custId = $value['customer_id'];

					$customerTableQuery = "select first_name, email_address from ".$customerTable." where customer_id = ".$custId.";";

					$customerTableQueryResults = $db->query($customerTableQuery); 

					while ( $dataCustomerTableQueryResults = $customerTableQueryResults->fetch_object() ) {
						$emailAddress = $dataCustomerTableQueryResults->email_address;
						$firstName = $dataCustomerTableQueryResults->first_name;
					}

				}



				$to = $emailAddress;
				$subject = "Order confirmation for order #".$orderId;
				$emailMessage = '<html><body>';
				$emailMessage = 'Hello '.$firstName.',';
				$emailMessage .= '<p>Thank you for your purchase. We hope you enjoy your delicious tamales!</p>';
				$emailMessage .= '<p>Your credit card has been charged for the following items:</p>';
				$emailMessage .= '<table>';
				$emailMessage .= '<tr><th width="250">Description</th><th width="50">price</th></tr>';

				while ( $dataFinalOrderDetailsResults = $finalOrderDetailsResults->fetch_object() ) { 

				$emailMessage .= '<tr><td>';
				$emailMessage .= $dataFinalOrderDetailsResults->product_name.'<br>';
				$emailMessage .= 'Quantity ordered: '.$dataFinalOrderDetailsResults->quantity.' dozen';
				$emailMessage .= '</td><td style="text-align:right" valign="bottom">';
				$emailMessage .= ' $'.number_format($itemTotal = $dataFinalOrderDetailsResults->unit_price * $dataFinalOrderDetailsResults->quantity, 2);
				$emailMessage .= '</td></tr>';

				} //end while loop

				$emailMessage .= '<tr><td colspan="2"><hr></td></tr>';

				foreach ($arrayFinalOrderTotalResults as $key => $value) {
				$taxAmount = $value['tax'] * $value['sub_total'];

				$emailMessage .= '<tr><td style="text-align:right;">';
				$emailMessage .= 'Subtotal : </td>';
				$emailMessage .= '<td style="text-align:right;">$'.$value['sub_total'].'</td>';
				$emailMessage .= '<tr><td style="text-align:right;">';
				$emailMessage .= 'tax : </td>';
				$emailMessage .= '<td style="text-align:right;">$'.number_format($taxAmount, 2).'</td>';
				$emailMessage .= '<tr><td style="text-align:right;">';
				$emailMessage .= 'Delivery Charge : </td>';
				$emailMessage .= '<td style="text-align:right;">$'.$value['delivery_charge'].'</td>';
				$emailMessage .= '<tr><td style="text-align:right;">';
				$emailMessage .= 'Total Charges : </td>';
				$emailMessage .= '<td style="text-align:right;">$'.$value['total'].'</td>';

				} //end foreach loop

				$emailMessage .= '</body></html>'; //end message


				$headers = "From:noreply@rfiguero.userworld.com" . "\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-type: text/html; charset=ISO-8859-1\r\n";
				mail($to, $subject, $emailMessage, $headers);
				

				header ("Location: home.php?message=complete");
			}

		}
	}



?>