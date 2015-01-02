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
	$product_category_table = "shopcart_product_category";
	$products_table = "shopcart_products";

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

	//$PHPSESSID=session_id(); 
	//echo $PHPSESSID;

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
	      	foreach ($arrayResultsForProducts as $key => $value) {
	          echo "<div class=\"row\"><div class=\"col-md-4\"><h3 class=\"product-name\">".$value['product_name']."</h3><img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\"></div>
	          		<div class=\"col-md-8\"><p class=\"description\">".$value['product_description']."</p><p>".$value['price']."</p><form><select><option value=\"\">1 dozen</option></select><button type=\"submit\" class=\"btn btn-success add-to-cart\">Add to cart</button></form></div>";
			  
			  //echo "<div class=\"col-sm-4\"><h3>".$value['product_name']."</h3><img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\"><p>
			  //<a role=\"button\" href=\"product_detail.php?product_id=".$value['product_id']."\" class=\"btn btn-success view-details\">View details »</a></p></div>";
	        }   
      }

      ?>


	</div>




	
</section>


<?php require 'footer.php'; ?>

