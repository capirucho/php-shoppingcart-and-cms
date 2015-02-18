<?php 

$adminHomeActive = echoActiveClassIfRequestMatches("admin_home");
$adminOrdersActive = echoActiveClassIfRequestMatches("admin_orders");
$adminProductsActive = echoActiveClassIfRequestMatches("admin_products");
$adminUsersActive = echoActiveClassIfRequestMatches("admin_users");
$adminCustomersActive = echoActiveClassIfRequestMatches("admin_customers");


echo "<ul class=\"admin_nav nav nav-pills\">".
"<li ".$adminOrdersActive." role=\"presentation\"><a href=\"admin_orders.php\">view orders</a></li>".
"<li ".$adminCustomersActive." role=\"presentation\"><a href=\"admin_customers.php\">view customers</a></li>".
"<li ".$adminProductsActive." role=\"presentation\"><a href=\"admin_products.php\">view products</a></>".
"<li ".$adminUsersActive." role=\"presentation\"><a href=\"admin_users.php\">view employees</a></li>".
"</ul>";



?>