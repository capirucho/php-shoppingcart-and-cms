<?php

// connect to db and application commonly used function /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';

// user defined functions for admin_home.php page ////


?>

<!doctype html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">		
		<title>Welcome to Abuelita's House of Tamales</title>


	    <!-- Bootstrap core CSS -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	    <!-- Bootstrap theme -->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css"

	    <!-- Custom styles for this template -->
	    <link href="theme.css" rel="stylesheet">

	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->


		<link rel="stylesheet" href="styles.css">
	</head>
	<body>
		<div id="main_wrapper">
			<header class="clearfix">
				<h1>Abuelita's House of Tamales</h1>
				<?php 
					$currentPage = basename($_SERVER['PHP_SELF']);
					if ($currentPage != "admin_login.php") {
						require 'admin_site_nav.php';
					}
				?>
				<div class="login_status">
					<?php
						if ( isUserLoggedIn() ) {
							//welcome user by name and show logout option
							echo "Welcome ".$_SESSION['username'];
							echo " | <a href=\"logout.php\">logout</a>";
						}
					?>
				</div>
			</header>
			