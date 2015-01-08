<?php require 'header.php'; ?>


<?php 


	if (isset($_GET['addedToCart'])) {
		echo $_GET['addedToCart'];

	}

?>

<h3>Items in your cart:</h3>
<?php
	
	//if (isset($_POST('continue_shopping'))) {
	//	header("Location: home.php");
	//}

	//if (isset($_POST('checkout'))) {
	//	header("Location: checkout.php");
	//}



	//if (isset($_GET['addedToCart'])) {
	//	echo $_GET['addedToCart'];

	//}	


	//get current session id and make sure it matches with stored user session ID
	$currentUserSessionId = session_id();

	//table to query
	$cartTable = "cart";
	$productsTable = "products";


	//the query
	$cartItemsQuery = "select product_name, product_image, sum(quantity) as quantity, price, session_id, ".$cartTable.".product_id from ".$productsTable." left outer join ".$cartTable." on ".$cartTable.".product_id = ".$productsTable.".product_id where ".$cartTable.".session_id = '".$currentUserSessionId."' GROUP BY products.product_name;";


	//the results from the queries
	$resultsForItemsInCart = $db->query($cartItemsQuery);

	//$numOfItemsInCart = $resultsForItemsInCart->num_rows;
	
	

	$numOfItemsInCart = $resultsForItemsInCart->num_rows;
	//echo "the number".$numOfItemsInCart;

	//declare session var for numOfItemsInCart
	//if ( isset($_SESSION["numOfItemsInCart"] ) ) {
		//$_SESSION["numOfItemsInCart"] = $numOfItemsInCart + 1;
	//}
	//else {
	//	$_SESSION["numOfItemsInCart"] = 0;
	//}

	//echo "num items in cart:".$numOfItemsInCart;


	if (!$resultsForItemsInCart) {
		echo "there was an error in query: $cartItemsQuery";
		echo $db->error;
	}
?>


<?php $grand_total = 0 ?>

<?php while ( $data = $resultsForItemsInCart->fetch_object() ) { ?>

		<div class="row cart-item clearfix">
			<div class="col-md-2"><img src="<?php echo $data->product_image; ?>" class="cart-image"></div>
			<div class="col-md-2">
				<h3><?php echo $data->product_name; ?></h3>
				price per dozen: <?php echo $data->price; ?><br>
				<?php echo $data->quantity; ?> dozen <a href="update_cart.php?edit">change amount</a>
			</div>
			<div class="col-md-2 item-total pull-left">
				<?php 
					$item_total = $data->price * $data->quantity;
					//$ctotal = number_format($item_total, 2);
					$grand_total = $grand_total + $item_total;

					echo "$".$item_total;
				?>					
			</div>
			<div class="col-md-6 item-total pull-left">
				<?php echo "<a href=\"update_cart.php?delete=".$data->product_id."\">delete this item</a>"; ?>	
			</div>
		</div>

<?php } //end while loop ?>
<div class="row total">
	<div class="panel panel-info">
	  <div class="panel-heading">
	    <h3 class="panel-title">Subtotal</h3>
	  </div>
	  <div class="panel-body">
	    <span class="amount"><?php echo "$".$grand_total; ?></span><br>
	    Shipping and Tax costs not included. These are added at checkout.
	  </div>
	</div>

	
</div>


<?php

	$resultsForItemsInCart->free();
	$db->close();	


?>

<!-- remove item from cart modal -->
<div id="removeItemModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add a New Tamales Product Category</h4>
      </div>
      <div class="modal-body">
        
      	<?php 

      		//if ( $resultsForCategoriesTable->num_rows >= 1 ) {
      		if ( !empty($finalResultsForCategories) ) {
      	?>		
		      	<div class="panel panel-info panel-default">
					  <div class="panel-heading">Categories of Tamales already offered:</div>
					  <div class="panel-body">
					  	<?php
							//if ( !empty($finalResultsForCategories) ) {

								foreach ($finalResultsForCategories as $key => $value) {
								    echo "<span class=\"label label-default\">".$value['category_name']."</span> ";
								}

							//}

					  		//echo "<ol class=\"current_cats clearfix\">";
							//while ( $currentCategories = $resultsForCategoriesTable->fetch_object() ) { 
							//	echo "<li>$currentCategories->category_name</li>";
							//}
							//echo "</ol>";
						?>
				  </div>
				</div>

      	<?php } ?>

		<form role="form" action="admin_add_category.php" method="POST">
		  <div class="form-group">
		    <label for="userName">Create a new category of Tamales</label>
		    <input name="category_name" type="text" class="form-control" id="category_name" placeholder="Example category: chicken, vegan">
		  </div>		  
		  <button type="submit" class="btn btn-success">Create a new Tamales Category</button>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php require 'footer.php'; ?>

















