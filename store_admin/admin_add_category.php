

<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';



	// user defined variables /////
	$table_name = "shopcart_product_category";

	function check_input ( $form_array ) {

		if ( $form_array[ 'category_name' ] ) {
		
			return 1;			
		}

		else return 0;
	}

	// Main Body  /////

	if ( check_input( $_POST ) ) {
		$categoryName = $db->real_escape_string( $_POST['category_name'] );

		# check if category exist 
		$foundCategory = 0;
		$theSQL = "select category_name from ".$table_name." where category_name = '" . $categoryName . "' limit 1";

		if ($theQueryResult = $db->query($theSQL) ) {
	
			if ( $data = $theQueryResult->fetch_object() ) {
				$foundCategory = 1;	

				if ($foundCategory == 1) {
					$message = "That category already exists! Please enter a different category.";
					header("Location: admin_products.php?categoryNameExists=$message");
					exit();
				}			
			}
		}
		$theQueryResult->free();


		# insert data into mysql database

		$insertCatQuery = "insert into ".$table_name." values (null, '".$categoryName."');";

		if ($db->query($insertCatQuery)) {
			$message = "A New Category for Tamales has been added!";
			header("Location: admin_products.php?categoryAdded=$message");
		} else {
			echo "<p>MySQL error no test {$db->errno} : {$db->error}</p>";
			exit();
		}


	}

	else {

			$message = "Please fill in all fields!";
			header("Location: admin_products.php?noBlanks=$message");

	}

?>

