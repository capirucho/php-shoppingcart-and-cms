<?php require 'header.php'; ?>


<?php 


	if (isset($_GET['catId'])) {
		$catId = $_GET['catId'];
	}

	//tables to query
	$products_table = "shopcart_products";
	//$category_table = "shopcart_product_category";

	//the queries
	$queryProdTable = "select * from ".$products_table." where product_category_id = ".$catId." order by product_name";
	//$queryCategoryTable = "select * from ".$category_table." order by category_name asc;";

	//the results from the queries
	$resultsForProductsTable = $db->query($queryProdTable); 
	//$resultsForCategoryTable = $db->query($queryCategoryTable); 

	//place the $resultsForCategoriesTable into an array so result set can be used more than once
	$arrayResultsForProducts = $resultsForProductsTable->fetch_all(MYSQLI_ASSOC); 	

?>

<h2>Viewing <?php echo "some category" ?></h2>
<?php
	 
    if ( !empty($arrayResultsForProducts) ) {
        echo "<div class=\"row\">";
?>

<?php
    foreach ($arrayResultsForProducts as $key => $value) {
        echo "<div class=\"col-sm-4\">";
        	echo "<h3 class=\"prod-title\">".$value['product_name']."</h3>";
        	echo "<img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\">";
        	echo "<p><a role=\"button\" href=\"product_detail.php?product_id=".$value['product_id']."\" class=\"btn btn-success view-details\">View details »</a></p>";
        echo "</div>";
    }
?>


<?php 
  echo "</div>";
} //end if 
?>
	








<?php require 'footer.php'; ?>