<?php 


require 'header.php'; 

// check if user has logged in /////
	//if ( !isUserLoggedIn() ) {
		//header("Location: admin_login.php");
	//}


?>

<?php 

	if ( isset($_GET['product_id']) ) {
		$productId = $db->real_escape_string( $_GET['product_id'] ); 
		echo $productId;
	//tables to query
	$product_category_table = "product_category";
	$products_table = "products";

	//the queries
	$queryTheCategoryTable = "select * from ".$product_category_table." order by category_name asc;";
	//$queryTheCategoryTableAgain = "select * from ".$product_category_table." order by category_name asc;";
	//$queryTheProductsTable = "select * from ".$products_table." order by product_name asc;";
	$queryTheProductsTable = "SELECT * FROM ".$products_table." WHERE product_id =".$productId.";";



	//the results from the queries
	$resultsForCategories = $db->query($queryTheCategoryTable);
	$resultsForProducts = $db->query($queryTheProductsTable);
	
	//dump the results into an array so result set can be used more than once
	$arrayResultsForProducts = $resultsForProducts->fetch_all(MYSQLI_ASSOC);
	$arrayResultsForCategories = $resultsForCategories->fetch_all(MYSQLI_ASSOC);	
		
	//print_r($finalResultsForCategories);



	//print_r($arrayResultsForProducts);


	}

	else {
		echo "Something went wrong!";
	}
	

?>

<section id="product-detail">
	<div class="clearfix">
      <?php 


      if ( !empty($arrayResultsForProducts) ) {
      ?>
      <form method="post" action="add_to_cart.php">

      	<?php
	      	foreach ($arrayResultsForProducts as $key => $value) {
	          echo "<div class=\"row\"><div class=\"col-md-4\"><h3 class=\"product-name\">".$value['product_name']."</h3><img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\"></div>
	          		<div class=\"col-md-8\"><p class=\"description\">".$value['product_description']."</p><p class=\"price\">$".$value['price']." per dozen (1 dozen = 12 tamales)</p><select name=\"quantity\"><option value=\"1\">1 dozen</option><option value=\"2\">2 dozen</option><option value=\"3\">3 dozen</option><option value=\"4\">4 dozen</option></select><button type=\"submit\" class=\"btn btn-success add-to-cart\">Add to cart</button></div>";
	        }
		?>
      	<!--<input name="user_session_id" type="hidden" value="<?php// echo $USER_SESSID ?>"> -->
      	<input name="pid" type="hidden" value="<?php echo $value['product_id'] ?>">

		</form>	  

	    <?php } ?>  


	</div>




	
</section>


<?php require 'footer.php'; ?>

