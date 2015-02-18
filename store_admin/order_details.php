
<?php

	if ( isset($_GET['orderId']) ) {
		$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : "";
		header("Location: admin_orders.php?orderId=$orderId");
	}

	if ( isset($_GET['custId']) ) {
		$customerId = isset($_GET['custId']) ? $_GET['custId'] : "";
		header("Location: admin_orders.php?showCustomerDetail=$customerId");
	}	

?>


