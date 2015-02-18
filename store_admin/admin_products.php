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

	if ( isset($_GET['productUpdated']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['productUpdated']."</div>";
	}

	if ( isset($_GET['deletedItem']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['deletedItem']."</div>";
	}

	if ( isset($_GET['categoryDeleted']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['categoryDeleted']."</div>";
	}

		if ( isset($_GET['selectCat']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['selectCat']."</div>";
	}		
	





	//tables to query
	$product_category_table = "shopcart_product_category";
	$products_table = "shopcart_products";

	//the queries
	$queryTheCategoryTable = "select * from ".$product_category_table." order by category_name asc;";
	$queryTheProductsTable = "select product_id, category_name, product_name, product_image, product_description, price FROM ".$products_table." 
	left outer join ".$product_category_table." on ".$products_table.".product_category_id = ".$product_category_table.".product_category_id order by ".$product_category_table.".category_name;";
	


	$show_edit_prod_modal = false;

	if ( isset($_POST['prodId']) ) {
		$prodId = $_POST['prodId'];
		

		$queryEditProdTable = "select product_id, ".$product_category_table.".product_category_id, category_name, product_name, product_image, product_description, price from ".$products_table." 
		left outer join ".$product_category_table." on ".$products_table.".product_category_id = ".$product_category_table.".product_category_id where "
		.$products_table.".product_id = ".$prodId.";";


		$resultsForEditProductTable = $db->query($queryEditProdTable);
		$arrayForEditProductTable = array();
		while ( $prodRow = mysqli_fetch_assoc($resultsForEditProductTable) ) {
			$arrayForEditProductTable[] = $prodRow;
		}

		$show_edit_prod_modal = true;

	}



	//the results from the queries
	$resultsForCategoriesTable = $db->query($queryTheCategoryTable);
	$resultsForProductsTable = $db->query($queryTheProductsTable);	
	

	//dump the $resultsForCategoriesTable into an array so result set can be used more than once
	$finalResultsForCategories = array();
	while ($catsRow = mysqli_fetch_assoc($resultsForCategoriesTable) ) {
		$finalResultsForCategories[] = $catsRow;
	}
?>


<section id="products">
	<div class="clearfix">
		<h2>List Of Tamales Offered</h2>
		<?php

				if ( !empty($finalResultsForCategories) ) {	
					echo "<a href=# class=\"view_categories\" data-toggle=\"modal\" data-target=\"#addCategoryForm\">view/edit tamal(es) categories</a>";
				}
		?>
		<div class="add_products"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#addProductForm">Add New Tamales</button></div>
	</div>


	<?php 

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
			<th></th>
		</tr>
		<?php 

			if ( $resultsForProductsTable->num_rows == 0 ) {
				echo "<tr><td colspan=\"6\">0 Tamales products found. Please add Tamales.</td></tr>";
			}
			while ( $data = $resultsForProductsTable->fetch_object() ) { 
				$prodIdToDelete = $data->product_id;
				echo "<tr>";
					echo "<td>$data->category_name</td>";
					echo "<td>$data->product_name</td>";
					echo "<td class=\"prod-image\">$data->product_image</td>";
					echo "<td>$data->product_description</td>";
					echo "<td>$data->price</td>";					
					echo "<td>";
						echo "<form class=\"edit-product\" action=\"admin_products.php\" method=\"post\">";
						echo "<input type=\"submit\" value=\"edit\" class=\"btn btn-success btn-xs\">";
						echo "<input name=\"prodId\" type=\"hidden\" value=\"$data->product_id\">";
						echo "</form>";
						echo "<a href=\"admin_edit_product.php?removeItem=".$prodIdToDelete."\" class=\"delete-product btn btn-danger btn-xs\">delete</a>";
					echo "</td>";				
				echo "</tr>";
				
			}

		?>
	</table>
	
</section>


<div id="addCategoryForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Manage Tamales Product Categories</h4>
      </div>
      <div class="modal-body">
        
      	<?php 

      		if ( !empty($finalResultsForCategories) ) {
      	?>		
	      	<div class="well">
				<h4>Current Categories:</h4>
			  	<form id="edit-current-cats-form" action="admin_delete_category.php" method="post">
				  	<div class="row">
				  		<div class="col-sm-8">
				  			<div class="form-group">
							  	<?php
										foreach ($finalResultsForCategories as $key => $value) {
											echo "<div class=\"category-result-item\">";
												echo "<input type=\"radio\" name=\"product_category_id\" value=\"".$value['product_category_id']."\">";
										    	echo "<span class=\"label label-default\">".$value['category_name']."</span> ";
										    echo "</div>";
										}
								?>
							</div>
						</div>
						<div class="col-sm-4">
							<input class="btn-danger btn-xs" type="submit" value="delete checked category">
						</div>
					</div>
				</form>
			</div>


      	<?php } ?>

			<div class="well">
				<form role="form" action="admin_add_category.php" method="POST">
				  <div class="form-group">
				    <label for="userName">Create a new category of Tamales</label>
				    <input name="category_name" type="text" class="form-control" id="category_name" placeholder="Example category: chicken, vegan">
				  </div>		  
				  <button type="submit" class="btn btn-success">Create a new Tamales Category</button>
				</form>
			</div>

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
				    <input name="product_image" type="text" class="form-control" id="product_image" placeholder="enter url. example: http://www.domain.com/image.jpg">
				  </div>
				  <div class="form-group">
				    <label for="product_description">Describe it!</label>
				    <textarea name="product_description" class="form-control" id="last_name" placeholder="describe how delecious it will be, and it's ingredients"></textarea>
				  </div>		  		  		  
				  <div class="form-group">
				    <label for="price">Price</label>
				    <input name="price" type="text" class="form-control" id="price" placeholder="Example: 12.00 (without the $)">
				  </div>	  
				  <button type="submit" class="btn btn-success">Add new product</button>
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







<div id="editProductModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	    <?php
	        foreach ($arrayForEditProductTable as $key => $value) { ?>
	        	<h4 class="modal-title">Editing <?php echo $value['product_name'] ?> Tamales Product</h4>
        <?php } //end foreach ?>
      </div>
      <div class="modal-body edit-content">
        
		<form role="form" action="admin_edit_product.php" method="POST">
			
			<div class="panel panel-default">
			  <div class="panel-heading">
			    <h3 class="panel-title">Step 1</h3>
			  </div>
			  <div class="panel-body">

				<div class="form-group">
					<label for="category">Change Tamales Category</label>
					<select name="product_category_id" id="category" class="form-control">

					    <?php 		
					    		foreach ( $arrayForEditProductTable  as $key => $value) { 					    	
					    			$currentCatId = $value['product_category_id'];
					    		}
					    		foreach ($finalResultsForCategories as $key => $value) {
					    			if ($currentCatId == $value['product_category_id'] ) {
										$currentCatSelected = "selected = \"selected\"";
									}
									else {
										$currentCatSelected = "";
									}
					    			echo "<option ".$currentCatSelected." name=\"product_category_id\" id=\"product_category_id\" value=\"".$value['product_category_id']."\">".$value['category_name']."</option>";
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
			  	<?php foreach ( $arrayForEditProductTable  as $key => $value) { ?>
				  <div class="form-group">
				    <label for="product_name">Tamales Name</label>
				    <input name="product_name" type="text" class="form-control" id="product_name" placeholder="Name for new Tamales" value="<?php echo $value['product_name'];?>">
				  </div>
				  <div class="form-group">
				    <label for="product_image">Image for this type of Tamales</label>
				    <input name="product_image" type="text" class="form-control" id="product_image" placeholder="enter url" value="<?php echo $value['product_image'];?>">
				  </div>
				  <div class="form-group">
				    <label for="product_description">Describe it!</label>
				    <textarea name="product_description" class="form-control" id="product_description"><?php echo $value['product_description'];?></textarea>
				  </div>		  		  		  
				  <div class="form-group">
				    <label for="price">Price</label>
				    <input name="price" type="text" class="form-control" id="price" placeholder="Enter price for a dozen" value="<?php echo $value['price'];?>">
				  </div>
				  <input name="product_id" type="hidden" value="<?php echo $prodId ?>">	  
				  <button type="submit" class="btn btn-success">Update</button>
				  <?php } //end foreach ?>
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


<?php if ( $show_edit_prod_modal ) { ?>

	<script>

		$('#editProductModal').modal('show');
		
	</script>

<?php } ?>


<?php

	$resultsForCategoriesTable->free();
	$resultsForProductsTable->free();
	$db->close();

?>

<?php require 'footer.php'; ?>

