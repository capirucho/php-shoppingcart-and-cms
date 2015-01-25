

<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';



	// user defined variables /////
	$table_name = "shopcart_products";

	function check_input ( $form_array ) {

		if ( $form_array[ 'product_category_id' ] && $form_array[ 'product_name' ] && $form_array[ 'product_image' ] 
			&& $form_array['product_description'] && $form_array['price'] ) {
		
			return 1;			
		}

		else return 0;
	}

	// Main Body  /////

	if ( check_input( $_POST ) ) {
		$catId = $db->real_escape_string( $_POST['product_category_id'] );
		$prodName = $db->real_escape_string( $_POST['product_name'] );
		$prodImage = $db->real_escape_string( $_POST['product_image'] );
		$prodDescription = $db->real_escape_string( $_POST['product_description'] );
		$price = $db->real_escape_string( $_POST['price'] );

		# check if product name exist
		$productNameExists = 0;
		$theSQL = "SELECT product_name FROM ".$table_name." WHERE product_name = '" . $prodName . "' LIMIT 1";

		if ($theQueryResult = $db->query($theSQL) ) {
	
			if ( $data = $theQueryResult->fetch_object() ) {
				$productNameExists = 1;	

				if ($productNameExists == 1) {
					$message = "Product Name already exists! Please choose a different name for these Tamales.";
					header("Location: admin_products.php?productNameExists=$message");
					exit();
				}			
			}
		}


		# insert product data into mysql database

		$insertProdQuery = "INSERT INTO ".$table_name." VALUES ('','".$catId."', now(), '".$prodName."', '".$prodImage."', '".$prodDescription."', 
					'".$price."');";

		if ($db->query($insertProdQuery)) {
			$message = "New Tamales product added successfully!";
			header("Location: admin_products.php?productAdded=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}


	}

	else {

		echo "Please fill in all fields.";

	}

?>

