<?php require 'header.php'; ?>


<?php
	
	//if (isset($_POST('continue_shopping'))) {
	//	header("Location: home.php");
	//}

	//if (isset($_POST('checkout'))) {
	//	header("Location: checkout.php");
	//}

	if (isset($_GET['userAdded'])) {
		echo $_GET['userAdded'];

	}


	//get current session id and make sure it matches with stored user session ID
	$currentUserSessionId = session_id();

	//table to query
	$cartTable = "cart";
	$productsTable = "products";


	//the query
	$cartItemsQuery = "select product_name, product_image, quantity, session_id from ".$productsTable." left outer join ".$cartTable." on ".$cartTable.".product_id = ".$productsTable.".product_id where ".$cartTable.".session_id = '".$currentUserSessionId."' ORDER BY products.product_name;";


	//the results from the queries
	$resultsForItemsInCart = $db->query($cartItemsQuery);


	if (!$resultsForItemsInCart) {
		echo "there was an error in query: $cartItemsQuery";
		echo $db->error;
	}


	while ( $data = $resultsForItemsInCart->fetch_object() ) { 
		echo "<br>$data->session_id $data->product_name $data->quantity<br>";
	}

	
	$resultsForItemsInCart->free();
	$db->close();	


?>

<?php require 'footer.php'; ?>