<?php

// connect to db /////
require 'shoppingcart_config.php';
require 'shoppingcart_functions.php';

// user defined functions for admin_home.php page ////


// Main Body  /////

// check if user has logged in /////
//if ( !isUserLoggedIn() ) {
//	header("Location: admin_login.php");
//}

?>

<!doctype html>
<html>
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">		
		<title>Welcome to Abuelita's House of Tamales</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
		<nav class="navbar navbar-default navbar-fixed-top">
		      <div class="container">
		        <div class="navbar-header">
		          <button aria-controls="navbar" aria-expanded="false" data-target="#navbar" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
		            <span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		          </button>
		          <a href="home.php" class="navbar-brand">Abuelita's House of Tamales</a>
		        </div>
		        <div class="navbar-collapse collapse" id="navbar">
		          <ul class="nav navbar-nav">
		            <li><a href="#about">Buy Tamales!</a></li>
		            <li><a href="#contact">Contact</a></li>
		          </ul>
		          <ul class="nav navbar-nav navbar-right">
		            <li>
		            	<?php 
		            		if ( isUserLoggedIn() ) {
							//welcome user by name and show logout option
							echo "Hi ".$_SESSION['customer_username'];
							echo " | <a href=\"customer_logout.php\">logout</a>";
							}
							else {
								echo "<a href=\"customer_login.php\">Sign in</a>";
							}
						?>
		            	

		            </li>
		            <!--<li><a href="../navbar/">Create an account</a> </li>-->
		            <li><a href=#>Cart: <?php //echo $_SESSION["numOfItemsInCart"]; ?></a></li>
		          </ul>
		        </div><!--/.nav-collapse -->
		      </div>
		</nav>

		<div class="main container">
			