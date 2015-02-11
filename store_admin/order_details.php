
<?php

	if ( isset($_GET['orderId']) ) {
		$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : "";
		header("Location: admin_orders.php?orderId=$orderId");
	}

?>


