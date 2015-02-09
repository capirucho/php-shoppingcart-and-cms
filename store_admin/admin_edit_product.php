<?php 

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';


	//post back prodID to admin prod page so that edit prod. modal works correctly
	if ( isset($_POST['prodId']) ) {
		$prodId = $_POST['prodId'];
		header("Location: admin_products.php?prodId=$prodId");
	}


	// gather post data from edit prod form and update prod table
	function check_input ( $form_array ) {

		if ($form_array[ 'product_id' ] && $form_array[ 'product_category_id' ] && $form_array[ 'product_name' ] && $form_array[ 'product_image' ] 
			&& $form_array['product_description'] && $form_array['price'] ) {
		
			return 1;			
		}

		else return 0;
	}

	// Main Body  /////

	$products_table = "shopcart_products";

	if ( check_input( $_POST ) ) {
		$prodId = $db->real_escape_string( $_POST['product_id'] );
		$catId = $db->real_escape_string( $_POST['product_category_id'] );
		$prodName = $db->real_escape_string( $_POST['product_name'] );
		$prodImage = $db->real_escape_string( $_POST['product_image'] );
		$prodDescription = $db->real_escape_string( $_POST['product_description'] );
		$price = $db->real_escape_string( $_POST['price'] );


		# update product data into mysql database
		$updateProdQuery = "update ".$products_table." set product_category_id = ".$catId.", product_name = '".$prodName."', product_image = '".$prodImage."', product_description = '".$prodDescription."', price = ".$price." where product_id =".$prodId.";";

		if ($db->query($updateProdQuery)) {
			$message = "New Tamales product updated successfully!";
			header("Location: admin_products.php?productUpdated=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}


	}

	else {
		$message = "Please fill in all fields!";
		header("Location: admin_products.php?noBlanks=$message");
	}



	if ( isset($_GET['removeItem']))  {
		$productToDelete = $db->real_escape_string( $_GET['removeItem'] );

		//remove item order details table (cart) from db table
		$deleteProductQuery = "delete from ".$products_table." where product_id = ".$productToDelete.";";

		if ($db->query($deleteProductQuery)) {
			$message = "Product removed from store!";
			header("Location: admin_products.php?deletedItem=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}

	 
	}



?>