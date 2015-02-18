
<?php
	require 'shoppingcart_functions.php';
	logoutUser();

?>

<!doctype html>
<html>
	<head>
		<title>Abuelita's House of Tamales</title>
	</head>
	<body>
		<header>
			<h1>Abuelita's House of Tamales</h1>
		</header>
		<section>
				<script>

					window.onload = init;

					function init () {
						alert("You have been successfully logged out.");
						setTimeout(function() { 
							window.location.replace("admin_login.php");
						}, 1000);
					}

				</script>


		</section>
	</body>
</html>