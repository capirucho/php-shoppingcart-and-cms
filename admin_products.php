<?php 


require 'header.php'; 

// check if user has logged in /////
if ( !isUserLoggedIn() ) {
	header("Location: admin_login.php");
}


?>

<?php 
	if ( isset($_GET['someParamOne']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['foundUserName']."</div>";
	}

	if ( isset($_GET['someParamTwo']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['userAdded']."</div>";
	}

?>

<section id="products">
	<div class="clearfix">
		<h2>List Of Tamales Offered</h2>
		<div class="add_products"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#addProductForm">Add New Tamales</button></div>
	</div>


	<?php 
		//tables to query
		$product_category_table = "shopcart_product_category";
		$products_table = "shopcart_products";

		//the queries
		$queryTheCategoryTable = "select * from ".$product_category_table." order by category_name asc;";
		$queryTheProductsTable = "select * from ".$products_table." order by product_name asc;";

		//the results
		$resultsForCategoriesTable = $db->query($queryTheCategoryTable);
		$resultsForProductsTable = $db->query($queryTheProductsTable);		

		if ($resultsForCategoriesTable->num_rows == 0) {
			$needCatMsg = "Click here to add a category.";
			echo "<div role=\"alert\" class=\"alert alert-warning\">Warning! You do not have any Tamales categories. You can not add Tamales products until you have added at least one category of Tamales. <a href=# class=\"alert-link\" data-toggle=\"modal\" data-target=\"#addCategoryForm\"><strong>".$needCatMsg."</strong></a></div>";
			//exit();
		}
	?>

	<table id="product_list" class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
		</tr>
		<?php 

			if ( $resultsForProductsTable->num_rows == 0 ) {
				print "<tr><td colspan=\"4\">0 Tamales products found. Please add Tamales.</td></tr>";
				//exit();
			}
			while ( $data = $resultsForProductsTable->fetch_object() ) { 
				print "<tr><td>$data->last_name</td><td>$data->first_name</td><td>$data->username</td><td>$data->email_address</td></tr>";
				
			}
			$resultsForCategoriesTable->free();
			$resultsForProductsTable->free();
			$db->close();
		?>
	</table>
	
</section>


<div id="addCategoryForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add a New Tamales Product</h4>
      </div>
      <div class="modal-body">
        

		<form role="form" action="admin_add_category.php" method="POST">
		  <div class="form-group">
		    <label for="userName">Create a new category of Tamales</label>
		    <input name="category_name" type="text" class="form-control" id="category_name" placeholder="Enter new Tamales Category">
		  </div>		  
		  <button type="submit" class="btn btn-default">Create an Admin User</button>
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
        

		<form role="form" action="admin_add_user.php" method="POST">
		  <div class="form-group">
		    <label for="userName">User Name</label>
		    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username (this will be your login name)">
		  </div>
		  <div class="form-group">
		    <label for="firstName">First Name</label>
		    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
		  </div>
		  <div class="form-group">
		    <label for="lastName">Last Name</label>
		    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
		  </div>		  		  		  
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
		  </div>
		  <div class="form-group">
		    <label for="UserEmail">Email address</label>
		    <input name="email_address" type="email" class="form-control" id="email_address" placeholder="Enter email">
		  </div>		  
		  <button type="submit" class="btn btn-default">Create an Admin User</button>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php require 'footer.php'; ?>

