<?php require 'header.php'; ?>


<?php 


	if (isset($_GET['catId'])) {
		$catId = $_GET['catId'];
	}

 
	if($catId == -1) {
		echo "<div class='alert alert-danger'>";
		echo "<strong>Please select what Category of Tamales you would like to view!</strong>!";
		echo "</div>";
	}



	//tables to query
	$products_table = "shopcart_products";
	$category_table = "shopcart_product_category";

	//the queries
	$queryCurrentCat = "select category_name from ".$category_table." where product_category_id = ".$catId." order by category_name";


	$queryProdCatTables = "select product_id, category_name, product_name, product_image FROM ".$products_table." left outer join ".$category_table." on "
	.$products_table.".product_category_id = ".$category_table.".product_category_id where ".$category_table.".product_category_id = ".$catId." ORDER BY "
	.$products_table.".product_name;";

	$queryCategoryTable = "select * from ".$category_table." order by category_name asc;";
	


	//the results from the queries
	$resultsForCurrentCat = $db->query($queryCurrentCat); 
	$resultsForProductsCatTables = $db->query($queryProdCatTables);
	$resultsForCategoryTable = $db->query($queryCategoryTable); 

	//place the $resultsForCategoriesTable into an array so result set can be used more than once
	$arrayResultsForProductsCats = $resultsForProductsCatTables->fetch_all(MYSQLI_ASSOC); 	

?>





  <div class="row">
    <div class="col-sm-8">
      <h1 class="cat-name">Viewing: <?php while ( $data = $resultsForCurrentCat->fetch_object() ) { echo $data->category_name; } ?> Tamales</h1>
    </div>
    <div class="col-sm-4">
      <form class="form-horizontal sortby" method="get" action="product_categories.php">
        <div class="form-group">
          <label for="choose-cat" class="col-sm-4 control-label">Sort by:&nbsp;</label>
          <select name="catId" id="choose-cat" class="form-control col-sm-8">
            <option selected value="-1"> -- select category -- </option>
            <?php while ( $dataCategories = $resultsForCategoryTable->fetch_object() ) { ?>
            <option class="category" value="<?php echo $dataCategories->product_category_id; ?>"><?php echo $dataCategories->category_name; ?></option>               
            <?php } //end while loop ?>
          </select>
          <button class="btn btn-success btn-sm go">go</button>
      </div>
        
      </form>
      
    </div>
  </div>




<?php
	 
    if ( !empty($arrayResultsForProductsCats) ) {
        echo "<div class=\"row\">";
?>

<?php
    foreach ($arrayResultsForProductsCats as $key => $value) {
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