<?php require 'header.php'; ?>


<?php 

  if (isset($_GET['catId'])) {
    $catId = $_GET['catId'];
  }

  //tables to query
  $products_table = "shopcart_products";
  $category_table = "shopcart_product_category";

  //query for current cat
  $queryCurrentCat = "select category_name from ".$category_table." where product_category_id = ".$catId." order by category_name";
  $queryCategoryTable = "select * from ".$category_table." order by category_name asc;";

  //the results from the queries
  $resultsForCurrentCat = $db->query($queryCurrentCat); 
  $resultsForCategoryTable = $db->query($queryCategoryTable); 

  if($catId == -1) {
  echo "<div class='alert alert-danger'>";
  echo "<strong>Please select what Category of Tamales you would like to view!</strong>!";
  echo "</div>";
  } 

?>

<div class="row">
  <div class="col-sm-7">
    <h1 class="cat-name">Viewing: 
      <?php 
        if ($catId !== -2 || $catId == -1 ) {
          while ( $data = $resultsForCurrentCat->fetch_object() ) { 
            echo $data->category_name." Tamales"; 
          }
          $resultsForCurrentCat->free(); 
        } 
        if ($catId == -2 ) { 
          echo "All Categories of Tamales";
        }
      ?> 
      
    </h1>
  </div>
  <div class="col-sm-5">
    <form class="form-horizontal sortby" method="get" action="product_categories.php">
      <div class="form-group">
        <label for="choose-cat" class="col-sm-4 control-label">Sort by:&nbsp;</label>
        <select name="catId" id="choose-cat" class="form-control col-sm-8">
          <option selected value="-1"> -- select category -- </option>
          <option value="-2">view all</option>
          <?php while ( $dataCategories = $resultsForCategoryTable->fetch_object() ) { ?>
          <option class="category" value="<?php echo $dataCategories->product_category_id; ?>"><?php echo $dataCategories->category_name; ?></option>               
          <?php 
              } //end while loop 
              $resultsForCategoryTable->free();
          ?>
        </select>
        <button class="btn btn-success btn-sm go">go</button>
      </div>
    </form>
    
  </div>
</div>


<?php
//catId == -2 shows all categories, catId == -1 no category selected
if ($catId !== -2 || $catId !== -1) {

  //the query for product/category where catId requested matches table
  $queryProdCatTables = "select product_id, category_name, product_name, product_image from ".$products_table." left outer join ".$category_table." on "
  .$products_table.".product_category_id = ".$category_table.".product_category_id where ".$category_table.".product_category_id = ".$catId." order by "
  .$products_table.".product_name;";

  //the results from the queries
  $resultsForProductsCatTables = $db->query($queryProdCatTables);


  //place the $resultsForCategoriesTable into an array so result set can be used more than once


  $arrayResultsForProductsCats = array();
  while ( $prodCatRow = mysqli_fetch_assoc($resultsForProductsCatTables) ) {
    $arrayResultsForProductsCats[] = $prodCatRow;
  }

  if ( !empty($arrayResultsForProductsCats) ) {
      echo "<div class=\"row\">";
        foreach ($arrayResultsForProductsCats as $key => $value) {
          echo "<div class=\"col-sm-4\">";
            echo "<h3 class=\"prod-title\">".$value['product_name']."</h3>";
            echo "<img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\">";
            echo "<p><a role=\"button\" href=\"product_detail.php?product_id=".$value['product_id']."\" class=\"btn btn-success view-details\">View details »</a></p>";
          echo "</div>";
        }
      echo "</div>";
  }
}
 
?>

<?php

//catId == -2 show all categories
if ($catId == -2) {

   //the query for product/category showing all cats
  $queryAllProdCatTables = "select * FROM ".$products_table." left outer join ".$category_table." on "
  .$products_table.".product_category_id = ".$category_table.".product_category_id order by "
  .$products_table.".product_name;"; 

  //the results from the query
  $resultsAllProductsCatTables = $db->query($queryAllProdCatTables);
  echo "<div class=\"row\">";
  while ( $dataAllProds = $resultsAllProductsCatTables->fetch_object() ) {
        
            echo "<div class=\"col-sm-4\">";
              echo "<h3 class=\"prod-title\">".$dataAllProds->product_name."</h3>";
              echo "<img class=\"prod_img img-thumbnail\" src=\"".$dataAllProds->product_image."\">";
              echo "<p><a role=\"button\" href=\"product_detail.php?product_id=".$dataAllProds->product_id."\" class=\"btn btn-success view-details\">View details »</a></p>";
            echo "</div>";
        

  }
  $resultsAllProductsCatTables->free();
  echo "</div>";
}


?>
	
<?php require 'footer.php'; ?>