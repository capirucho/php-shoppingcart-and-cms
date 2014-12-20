<?php 

$adminHomeActive = echoActiveClassIfRequestMatches("admin_home");
$adminOrdersActive = echoActiveClassIfRequestMatches("admin_orders");
$adminProductsActive = echoActiveClassIfRequestMatches("admin_products");
$adminCategoriesActive = echoActiveClassIfRequestMatches("admin_categories");
$adminUsersActive = echoActiveClassIfRequestMatches("admin_users");
$adminCustomersActive = echoActiveClassIfRequestMatches("admin_customers");


echo "<ul class=\"admin_nav nav nav-pills\">".
"<li ".$adminHomeActive." role=\"presentation\"><a href=\"admin_home.php\">home</a></li>".
"<li ".$adminOrdersActive." role=\"presentation\"><a href=\"admin_orders.php\">orders</a></li>".
"<li ".$adminProductsActive." role=\"presentation\"><a href=\"admin_products.php\">products</a></>".
"<li ".$adminCategoriesActive." role=\"presentation\"><a href=\"admin_categories.php\">product categories</a></li>".
"<li ".$adminUsersActive." role=\"presentation\"><a href=\"admin_users.php\">admin users</a></li>".
"<li ".$adminCustomersActive." role=\"presentation\"><a href=\"admin_customers.php\">customers</a></li>".
"</ul>";



?>