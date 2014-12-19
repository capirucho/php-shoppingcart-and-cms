<?php

// start a session /////
session_start();	


//todo: change host, user name and password and database to match your db host

$host = "localhost";
$user = "rfigueroa";
$pw = "YourPassWordHere";
$database = "shopping_cart";


$db = new mysqli( $host, $user, $pw, $database ) or die( "Cannot connect to MySQL" );

?>