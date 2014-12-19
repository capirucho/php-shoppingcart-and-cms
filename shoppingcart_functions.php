<?php


//checks to see if user is logged in /////
function isUserLoggedIn() {

	if ( isset($_SESSION['username']) ) {	
		return true;
	}
	return false;
}

//logout user /////
//function logoutUser() {

	// Initialize the session.
	// If you are using session_name("something"), don't forget it now!
	//session_start();

	// Unset all of the session variables.
	//$_SESSION = array();

	// If it's desired to kill the session, also delete the session cookie.
	// Note: This will destroy the session, and not just the session data!
	//if (ini_get("session.use_cookies")) {
	 //   $params = session_get_cookie_params();
	  //  setcookie(session_name(), '', time() - 42000,
	   //     $params["path"], $params["domain"],
	       // $params["secure"], $params["httponly"]
	    //);
	//}

	// Finally, destroy the session.

	//session_start();
	//session_destroy();
	//header("Location: logout.php");

	//return true;

//}


?>