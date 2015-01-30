<?php 

require 'header.php'; 

?>

<?php 

	if ( isset($_GET['product_id']) ) {
		$productId = $db->real_escape_string( $_GET['product_id'] ); 
		echo $productId;
	//tables to query
	$product_category_table = "shopcart_product_category";
	$products_table = "shopcart_products";

	//the queries
	$queryTheCategoryTable = "select * from ".$product_category_table." order by category_name asc;";
	$queryTheProductsTable = "select * from ".$products_table." where product_id =".$productId.";";



	//the results from the queries
	$resultsForCategories = $db->query($queryTheCategoryTable);
	$resultsForProducts = $db->query($queryTheProductsTable);
	
	//dump the results into an array so result set can be used more than once
	$arrayResultsForProducts = $resultsForProducts->fetch_all(MYSQLI_ASSOC);
	$arrayResultsForCategories = $resultsForCategories->fetch_all(MYSQLI_ASSOC);	
		
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
	          echo "<div class=\"row\">";
	          	echo "<div class=\"col-md-4\">";
	          		echo "<h3 class=\"product-name\">".$value['product_name']."</h3>";
	          		echo "<img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\">";
	          	echo "</div>";
	          	echo "<div class=\"col-md-8\">";
	          		echo "<p class=\"description\">".$value['product_description']."</p>";
	          		echo "<p class=\"price\">$".$value['price']." per dozen (1 dozen = 12 tamales)</p>";
	          		echo "<select name=\"quantity\">";
	          			echo "<option value=\"1\">1 dozen</option>";
	          			echo "<option value=\"2\">2 dozen</option>";
	          			echo "<option value=\"3\">3 dozen</option>";
	          			echo "<option value=\"4\">4 dozen</option>";
	          			echo "<option value=\"5\">5 dozen</option>";
	          			echo "<option value=\"6\">6 dozen</option>";
	          		echo "</select>";
	          		echo "<button type=\"submit\" class=\"btn btn-success add-to-cart\">Add to cart</button>";
	          echo "</div>";
	        }
		?>
      	<input name="prodname" type="hidden" value="<?php echo $value['product_name'] ?>">
      	<input name="unitprice" type="hidden" value="<?php echo $value['price'] ?>">
      	<input name="pid" type="hidden" value="<?php echo $value['product_id'] ?>">

		</form>	  

	    <?php } //end if ?>  


	</div>




	
</section>


<?php require 'footer.php'; ?>

