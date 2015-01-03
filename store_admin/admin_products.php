<?php 


require 'header.php'; 

// check if user has logged in /////
	if ( !isUserLoggedIn() ) {
		header("Location: admin_login.php");
	}


?>

<?php 

	if ( isset($_GET['categoryNameExists']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['categoryNameExists']."</div>";
	}

	if ( isset($_GET['categoryAdded']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['categoryAdded']."</div>";
	}

	if ( isset($_GET['productNameExists']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['productNameExists']."</div>";
	}

	if ( isset($_GET['noBlanks']) ) {
		echo "<div role=\"alert\" class=\"alert alert-warning\">".$_GET['noBlanks']."</div>";
	}	
	

	//tables to query
	$product_category_table = "product_category";
	$products_table = "products";

	//the queries
	$queryTheCategoryTable = "select * from ".$product_category_table." order by category_name asc;";
	//$queryTheCategoryTableAgain = "select * from ".$product_category_table." order by category_name asc;";
	//$queryTheProductsTable = "select * from ".$products_table." order by product_name asc;";
	$queryTheProductsTable = "SELECT category_name, product_name, product_image, product_description, price FROM ".$products_table." left outer join product_category on products.product_category_id = product_category.product_category_id ORDER BY product_category.category_name;";



	//the results from the queries
	$resultsForCategoriesTable = $db->query($queryTheCategoryTable);
	//$resultsForCategoriesTableAgain = $db->query($queryTheCategoryTableAgain);
	$resultsForProductsTable = $db->query($queryTheProductsTable);	

	//dump the $resultsForCategoriesTable into an array so result set can be used more than once
	$finalResultsForCategories = $resultsForCategoriesTable->fetch_all(MYSQLI_ASSOC);	

	//print_r($finalResultsForCategories);


?>

<section id="products">
	<div class="clearfix">
		<h2>List Of Tamales Offered</h2>
		<?php

				//if ($resultsForCategoriesTable->num_rows >= 1) {
				if ( !empty($finalResultsForCategories) ) {	
					echo "<a href=# class=\"view_categories\" data-toggle=\"modal\" data-target=\"#addCategoryForm\">view/edit tamal(es) categories</a>";
				}
		?>
		<div class="add_products"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#addProductForm">Add New Tamales</button></div>
	</div>


	<?php 


		//if ($resultsForCategoriesTable->num_rows == 0) {
		if ( empty($finalResultsForCategories) ) {
			$needCatMsg = "Click here to add a category.";
			echo "<div role=\"alert\" class=\"alert alert-warning\">Warning! You do not have any Tamales categories. You can not add Tamales products until you have added at least one category of Tamales. <a href=# class=\"alert-link\" data-toggle=\"modal\" data-target=\"#addCategoryForm\"><strong>".$needCatMsg."</strong></a></div>";
		}

	?>

	<table id="product_list" class="table table-striped">
		<tr>
			<th>Category</th>	
			<th>Name</th>
			<th>Image</th>
			<th>Description</th>
			<th>Price</th>
		</tr>
		<?php 

			if ( $resultsForProductsTable->num_rows == 0 ) {
				echo "<tr><td colspan=\"5\">0 Tamales products found. Please add Tamales.</td></tr>";
				//exit();
			}
			while ( $data = $resultsForProductsTable->fetch_object() ) { 
				echo "<tr><td>$data->category_name</td><td>$data->product_name</td><td>$data->product_image</td><td>$data->product_description</td><td>$data->price</td></tr>";
				
			}

		?>
	</table>
	
</section>


<div id="addCategoryForm" class="modal fade">
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



<div id="addProductForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add a New Tamales Product</h4>
      </div>
      <div class="modal-body">
        

		<form role="form" action="admin_add_product.php" method="POST">
			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Step 1</h3>
			  </div>
			  <div class="panel-body">

				<div class="form-group">
					<label for="category">Choose Tamales Category</label>
					<select name="product_category_id" id="category" class="form-control">
					    <!--<option selected="selected" value="" disabled="disabled">-- select tamales category</option>-->

					    <?php 

					    		foreach ($finalResultsForCategories as $key => $value) {
					    			echo "<option name=\"product_category_id\" id=\"product_category_id\" value=\"".$value['product_category_id']."\">".$value['category_name']."</option>";
					    		}   
					    ?>
					</select>
				</div>

			  </div>
			</div>

			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Step 2</h3>
			  </div>
			  <div class="panel-body">
				  <div class="form-group">
				    <label for="product_name">Tamales Name</label>
				    <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Name for new Tamales">
				  </div>
				  <div class="form-group">
				    <label for="product_image">Image for this type of Tamales</label>
				    <input name="product_image" type="text" class="form-control" id="product_image" placeholder="enter url">
				  </div>
				  <div class="form-group">
				    <label for="product_description">Describe it!</label>
				    <textarea name="product_description" class="form-control" id="last_name" placeholder="describe how delecious it will be, and it's ingredients"></textarea>
				  </div>		  		  		  
				  <div class="form-group">
				    <label for="price">Price</label>
				    <input name="price" type="text" class="form-control" id="price" placeholder="Enter price for a dozen">
				  </div>	  
				  <button type="submit" class="btn btn-success">Create new Tamales product</button>
			  </div>
			</div>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php

	$resultsForCategoriesTable->free();
	$resultsForProductsTable->free();
	$db->close();

?>

<?php require 'footer.php'; ?>

