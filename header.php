<?php

// connect to db /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';

// user defined functions for admin_home.php page ////


// Main Body  /////

// check if user has logged in /////
if ( !isUserLoggedIn() ) {
	header("Location: admin_login.php");
}

?>

<!doctype html>
<html>
	<head>
		<title>Welcome to Abuelita's House of Tamales</title>
		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div id="main_wrapper">
			<header class="clearfix">
				<h1>Abuelita's House of Tamales</h1>
				<?php require 'admin_site_nav.php' ?>
				<div class="login_status">
					<?php
						if ( isUserLoggedIn() ) {
							//welcome user by name and show logout option
							echo "Welcome ".$_SESSION['username'];
							echo " | <a href=\"logout.php\">logout</a>";
						}
						//else {
							//redirect user to login page
							//header("Location: admin_login.php");
						//}

					?>
				</div>
			</header>
			