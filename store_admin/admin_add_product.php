

<?php

	// connect to db /////
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

		$insertProdQuery = "INSERT INTO ".$table_name." VALUES ('','".$catId."', '".$prodName."', '".$prodImage."', '".$prodDescription."', 
					'".$price."');";

		if ($db->query($insertProdQuery)) {
			//echo "New Record has id ".$mysqli->insert_id;
			$message = "New Tamales product added successfully!";
			header("Location: admin_products.php?productAdded=$message");
		} else {
			echo "<p>MySQL error no {$db->errno} : {$db->error}</p>";
			exit();
		}


	}

	else {

		echo "Please fill in all fields.";
		# insert data into mysql database
		/*
		$commandCrap = "insert into $table_name VALUES ('"$db->real_escape_string($userName)."', '".$db->real_escape_string($firstName)."', '".$db->real_escape_string($lastName)."', 
					'".$db->real_escape_string($password)."', '".$db->real_escape_string($email)."');";

		if ($db->query($commandCrap)) {
			//echo "New Record has id ".$mysqli->insert_id;
			echo "<p>Registred successfully!</p>";
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
		*/
	}

	//$result->free();
	//$db->close();

		//my shit here
			
		//$command = "INSERT INTO $table_name values('','".$db->real_escape_string($_POST['author_name'])."',
		//now(),'".$db->real_escape_string($_POST['post_title'])."',
		//'".$db->real_escape_string($_POST['post_image_url'])."', '".$db->real_escape_string($_POST['post_content'])."');";

		//$db->query($command);
		
		
		//print "User was successfully registered.<br>";
		
		//$db->close();
	//}
	//else {

		//print "Data was NOT entered due to errors:<br>".mysql_error();
	//}

	//<a href="http://rfiguero.userworld.com/LearninPHPandMySQL/lesson10/home_blog.php">Back To Homepage</a>


?>

