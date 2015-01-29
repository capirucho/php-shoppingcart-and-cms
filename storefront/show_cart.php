<?php require 'header.php'; ?>


<?php 


	if (isset($_GET['addedToCart'])) {
		echo $_GET['addedToCart'];

	}

?>

<h3>Items in your cart:</h3>
<?php
	

	//get current session id and make sure it matches with stored user session ID
	$currentUserSessionId = session_id();

	//table to query
	$cartTable = "shopcart_order_details";
	$productsTable = "shopcart_products";


	//the query
	$cartItemsQuery = "select ".$cartTable.".product_name, product_image, sum(quantity) as quantity, price, session_id, ".$cartTable.".product_id from "
	.$productsTable." left outer join ".$cartTable." on ".$cartTable.".product_id = ".$productsTable.".product_id where ".$cartTable.".session_id = '"
	.$currentUserSessionId."' and checkout_status = 'incomplete' GROUP BY ".$productsTable.".product_name;";



	//the results from the queries
	$resultsForItemsInCart = $db->query($cartItemsQuery);

	
	
	
	/* TODO: show num items in cart

	$numOfItemsInCart = $resultsForItemsInCart->num_rows;
	echo "the number".$numOfItemsInCart;

	//declare session var for numOfItemsInCart
	if ( isset($_SESSION["numOfItemsInCart"] ) ) {
		//$_SESSION["numOfItemsInCart"] = $numOfItemsInCart + 1;
	}
	else {
		$_SESSION["numOfItemsInCart"] = 0;
	}

	echo "num items in cart:".$numOfItemsInCart;


	if (!$resultsForItemsInCart) {
		echo "there was an error in query: $cartItemsQuery";
		echo $db->error;
	}
	*/
?>


<?php $sub_total = 0 ?>

<?php while ( $data = $resultsForItemsInCart->fetch_object() ) { ?>

		<div class="row cart-item clearfix">
			<div class="col-md-2"><img src="<?php echo $data->product_image; ?>" class="cart-image"></div>
			<div class="col-md-2">
				<h3><?php echo $data->product_name; ?></h3>
				price per dozen: <?php echo $data->price; ?><br>
				Current amount: <strong><?php echo $data->quantity; ?> dozen</strong>
			</div>
			<div class="col-md-2 item-total pull-left">
				<?php 
					$item_total = $data->price * $data->quantity;
					$item_total = number_format($item_total, 2);
					$sub_total = $sub_total + $item_total;

					echo "$".$item_total;
				?>					
			</div>
			<div class="col-md-6 item-total pull-left">
				<?php echo "<a href=\"delete_cart_item.php?removeItem=".$data->product_id."\">delete this item</a>"; ?>	
			</div>
		</div>

<?php } //end while loop ?>
<div class="row total">
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <h3 class="panel-title">Subtotal</h3>
	  </div>
	  <div class="panel-body">
	    <span class="amount"><?php echo "$".number_format($sub_total,2); ?></span><br>
	    Shipping and Tax costs not included. These are added at checkout.<br><br>
	    <?php if ( !isset($_SESSION['customerId']) ) { ?>
	    	
		    <form action="checkout.php" method="post">
		      	<?php if ( $sub_total > 0 ) { ?>
		    	<button type="submit" class="btn btn-primary">Check out</button>
		    	<?php } ?>
		    <form>

		<?php } else { $custId = $_SESSION['customerId']; ?>
			
		    <form action="create_order.php" method="get">
		      	<?php if ( $sub_total > 0 ) { ?>
		      	<input type="hidden" value="<?php echo $custId ?>">
		    	<button type="submit" class="btn btn-primary">Check out</button>
		    	<?php } ?>
		    <form>

		<?php } ?>
	  </div>
	</div>

	
</div>


<?php

	$resultsForItemsInCart->free();
	$db->close();	

?>




<?php require 'footer.php'; ?>

















