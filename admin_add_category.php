

<?php

	// connect to db /////
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
		$theSQL = "SELECT category_name FROM ".$table_name." WHERE category_name = '" . $categoryName . "' LIMIT 1";

		if ($theQueryResult = $db->query($theSQL) ) {
	
			if ( $data = $theQueryResult->fetch_object() ) {
				$foundUserName = 1;	

				if ($foundUserName == 1) {
					$message = "That category already exists! Please choose a different category.";
					header("Location: admin_products.php?categoryNameExists=$message");
				}			
			}
		}


		# insert data into mysql database

		$insertCatQuery = "INSERT INTO ".$table_name." VALUES (null, '".$categoryName."');";

		if ($db->query($insertCatQuery)) {
			//echo "New Record has id ".$mysqli->insert_id;
			$message = "A New Category for Tamales has been added!";
			header("Location: admin_products.php?categoryAdded=$message");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
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

