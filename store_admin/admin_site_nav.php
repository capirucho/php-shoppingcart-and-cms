<?php 

$adminHomeActive = echoActiveClassIfRequestMatches("admin_home");
$adminOrdersActive = echoActiveClassIfRequestMatches("admin_orders");
$adminProductsActive = echoActiveClassIfRequestMatches("admin_products");
//$adminCategoriesActive = echoActiveClassIfRequestMatches("admin_product_categories");
$adminUsersActive = echoActiveClassIfRequestMatches("admin_users");
$adminCustomersActive = echoActiveClassIfRequestMatches("admin_customers");


echo "<ul class=\"admin_nav nav nav-pills\">".
//"<li ".$adminHomeActive." role=\"presentation\"><a href=\"admin_home.php\">home</a></li>".
"<li ".$adminOrdersActive." role=\"presentation\"><a href=\"admin_orders.php\">view orders</a></li>".
"<li ".$adminProductsActive." role=\"presentation\"><a href=\"admin_products.php\">add tamales</a></>".
//"<li ".$adminCategoriesActive." role=\"presentation\"><a href=\"admin_product_categories.php\">add tamales types</a></li>".
"<li ".$adminUsersActive." role=\"presentation\"><a href=\"admin_users.php\">view employees</a></li>".
"<li ".$adminCustomersActive." role=\"presentation\"><a href=\"admin_customers.php\">view customers</a></li>".
"</ul>";



?>