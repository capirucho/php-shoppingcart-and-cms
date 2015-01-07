<?php

//checks for page url and sets class to "active" if page url request matches current page

function echoActiveClassIfRequestMatches($requestUri)
{
  $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

  if ($current_file_name == $requestUri) {
      return 'class="active"';
  }
  return '';
}


//checks to see if user is logged in /////
function isUserLoggedIn() {

	if ( isset($_SESSION['username']) ) {	
		return true;
	}
	return false;
}

//logout user /////
function logoutUser() {

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

}

function showTotalItemsInCart ($numOfItemsInCart) {
	global $numOfItemsInCart;
	$fuckoff = $numOfItemsInCart;
	return $fuckOff;

	//header("Location: header.php?cart=$message");
}


?>