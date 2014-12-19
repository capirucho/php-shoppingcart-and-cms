
<?php

	// Unset all of the session variables.
	$_SESSION = array();

	// Delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000,
	        $params["path"], $params["domain"],
	        $params["secure"], $params["httponly"]
	    );
	}

	session_start();
	session_destroy();

?>

<!doctype html>
<html>
	<head>
		<title>Abuelita's House of Tamales</title>
		<link rel="stylesheet" href="blogstyles.css">
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
						}, 3000);
					}

				</script>


		</section>
	</body>
</html>