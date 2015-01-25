<?php 

//get site header
require 'header.php'; 


  //tables to query
  $products_table = "shopcart_products";

  //the queries
  $queryTheProductsTable = "select * from ".$products_table." order by date_added desc limit 6;";

  //the results from the queries
  $resultsForProductsTable = $db->query($queryTheProductsTable);  

  //place the $resultsForCategoriesTable into an array so result set can be used more than once
  $arrayResultsForProducts = $resultsForProductsTable->fetch_all(MYSQLI_ASSOC); 



?>


      <!-- Jumbotron -->
      <div class="jumbotron">
        <h1>Come get some tamales!</h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet.</p>
        <p><a role="button" href="#" class="btn btn-lg btn-success">Get started today</a></p>
      </div>

      <h1>Our Newest Tamales Offerings</h1>
      <?php 
        if ( !empty($arrayResultsForProducts) ) {
            echo "<div class=\"row\">";
      ?>

      <?php
            foreach ($arrayResultsForProducts as $key => $value) {
                echo "<div class=\"col-sm-4\"><h3>".$value['product_name']."</h3><img class=\"prod_img img-thumbnail\" src=\"".$value['product_image']."\"><p>
                <a role=\"button\" href=\"product_detail.php?product_id=".$value['product_id']."\" class=\"btn btn-success view-details\">View details »</a></p></div>";
            }
      ?>
      <?php 
          echo "</div>";
        } //end if 
      ?>

<?php require 'footer.php'; ?>