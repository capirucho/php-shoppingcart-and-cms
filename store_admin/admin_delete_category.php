
<?php

	// connect to db and application commonly used function /////
	require 'shoppingcart_config.php';
	require 'shoppingcart_functions.php';


	function check_input ( $form_array ) {

		if ( $form_array[ 'product_category_id' ] ) {
		
			return 1;			
		}

		else return 0;
	}




	$category_table = "shopcart_product_category";

	if ( check_input( $_POST ) ) {
		$catId = $db->real_escape_string( $_POST['product_category_id'] );
		echo $catId;
		//exit();
		//remove category from category table (cart) from db table
		$deleteProductQuery = "delete from ".$category_table." where product_category_id = ".$catId.";";

		if ($db->query($deleteProductQuery)) {
			$message = "Category deleted!";
			header("Location: admin_products.php?categoryDeleted=$message");
		} else {
			echo "<p>MySQL error no ".$db->errno." : ".$db->error."</p>";
			exit();
		}


	} else {
			$message = "Please select a category you want to delete.";
			header("Location: admin_products.php?selectCat=$message");
	}

?>