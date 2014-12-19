<?php
// connect to db /////
//require 'shoppingcart_config.php';

?>

<!doctype html>
<html>
	<head>
		<title>Welcome to Abuelita's House of Tamales</title>
		<link rel="stylesheet" href="blogstyles.css">
	</head>
	<body>
			<h1>Abuelita's House of Tamales</h1>
			<form action="process_admin_login.php" method="post">

				<table border="0">
				   <tr>
				     <td width="100">Username: </td>
				     <td width="200"><input type="text" name="username" size="30"></td>
				   </tr>
				   <tr>
				   	<td width="100">Password: </td>
				   	<td width="200"><input type="text" name="password" size="30"></td>
				   </tr>
				</table>
				<input type="submit" value="Submit">


			</form>
	</body>
</html>