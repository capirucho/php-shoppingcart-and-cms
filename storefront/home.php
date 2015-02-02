<?php 

//get site header
require 'header.php'; 


  //tables to query
  $products_table = "shopcart_products";
  $category_table = "shopcart_product_category";

  //the queries
  $queryTheProductsTable = "select * from ".$products_table." order by date_added desc limit 6;";
  $queryCategoryTable = "select * from ".$category_table." order by category_name asc;";

  //the results from the queries
  $resultsForProductsTable = $db->query($queryTheProductsTable); 
  $resultsForCategoryTable = $db->query($queryCategoryTable); 

  //place the $resultsForCategoriesTable into an array so result set can be used more than once
  $arrayResultsForProducts = $resultsForProductsTable->fetch_all(MYSQLI_ASSOC); 



?>

      <?php 
      
      //$message = isset($_GET['message']) ? $_GET['message'] : "";
      //$productName = isset($_GET['prodName']) ? $_GET['prodName'] : "";



      if ( isset($_GET['message']) ) {
        $message = $_GET['message'];
      }
      else {
        $message = "";
      }

      if ( isset($_GET['prodName']) ) {
        $productName = $_GET['prodName'];
      }
      else {
        $productName = "";
      }


      if($message == 'complete') {
          echo "<div class='alert alert-success'>";
              echo "<strong>Your order of delicious Tamales has been successfully placed. We appreciate your business!</strong>!";
          echo "</div>";
      }

      if($message == 'added') {
          echo "<div class='alert alert-success'>";
              echo "<strong>{$productName}</strong> tamales were added to your cart!";
          echo "</div>";
      }
       
      if($message == 'exists') {
          echo "<div class='alert alert-warning'>";
              echo "<strong>{$productName}</strong> tamales are already in your cart!";
          echo "</div>";
      }


            
      ?>
      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Come get some tamales!</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
        <p><a role="button" href="#" class="btn btn-lg btn-success">Order some today!</a></p>
      </div>
      <div class="row">
        <div class="col-sm-8">
          <h1>Our Newest Tamales Offerings</h1>
        </div>
        <div class="col-sm-4">
          <form class="form-horizontal sortby" method="get" action="product_categories.php">
            <div class="form-group">
              <label for="choose-cat" class="col-sm-4 control-label">Sort by:&nbsp;</label>
              <select name="catId" id="choose-cat" class="form-control col-sm-8">
                <option selected disabled> -- select one -- </option>
                <?php while ( $data = $resultsForCategoryTable->fetch_object() ) { ?>
                <option class="category" value="<?php echo $data->product_category_id; ?>"><?php echo $data->category_name; ?></option>               
                <?php } //end while loop ?>
              </select>
              <button class="btn btn-success btn-sm go">go</button>
          </div>
            
          </form>
          
        </div>
      </div>
      <?php 
        if ( !empty($arrayResultsForProducts) ) {
            echo "<div class=\"row\">";
      ?>

      <?php
            foreach ($arrayResultsForProducts as $key => $value) {
                echo "<div class=\"col-sm-4\"><h3 class=\"prod-title\">".$value['product_name']."</h3><img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\"><p>
                <a role=\"button\" href=\"product_detail.php?product_id=".$value['product_id']."\" class=\"btn btn-success view-details\">View details »</a></p></div>";
            }
      ?>
      <?php 
          echo "</div>";
        } //end if 
      ?>

<?php require 'footer.php'; ?>