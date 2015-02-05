<?php 


require 'header.php'; 

// check if user has logged in /////
if ( !isUserLoggedIn() ) {
	header("Location: admin_login.php");
}


?>

<?php 
	if ( isset($_GET['foundUserName']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['foundUserName']."</div>";
	}

	if ( isset($_GET['userAdded']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['userAdded']."</div>";
	}

?>

<section id="orders">
	<div class="clearfix">
		<h2>Current Orders</h2>
	</div>
	<table id="employee_list" class="table table-striped">
		<tr>
			<th>Order Id</th>
			<th>Order Status</th>
			<th>Customer Id</th>
			<th>Sub Total</th>
			<th>Tax</th>
			<th>Delivery Charge</th>
			<th>Total</th>
		</tr>
		<?php 

			$orders_table = "shopcart_orders";
			$command = "select * from ".$orders_table." order by order_id asc;";
			$result = $db->query($command);	

			while ( $data = $result->fetch_object() ) {

				echo "<tr>";
					echo "<td><a id=\"$data->order_id\" href=\"order_details.php?orderId=".$data->order_id."\" class=\"order-id\">$data->order_id</a></td>";
					echo "<td>$data->order_status</td>";
					echo "<td>$data->customer_id</td>";
					echo "<td>$".$data->sub_total."</td>";
					echo "<td>$data->tax%</td>";
					echo "<td>$".$data->delivery_charge."</td>";
					echo "<td>$".$data->total."</td>";
				echo "</tr>";

			}
			$result->free();
			$db->close();
		?>
	</table>
	
</section>


<?php require 'footer.php'; ?>
