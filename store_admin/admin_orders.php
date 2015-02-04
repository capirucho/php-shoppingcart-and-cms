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
					echo "<td><a href=\"admin_orders.php?orderId=".$data->order_id."\" data-toggle=\"modal\" data-target=\"#orderDetails\" class=\"order-id\" >$data->order_id</a></td>";
					echo "<td>$data->order_status</td>";
					echo "<td>$data->customer_id</td>";
					echo "<td>$".$data->sub_total."</td>";
					echo "<td>$data->tax</td>";
					echo "<td>$".$data->delivery_charge."</td>";
					echo "<td>$".$data->total."</td>";
				echo "</tr>";
			}
			$result->free();
			$db->close();
		?>
	</table>
	
</section>








<div id="orderDetails" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Details for Order: </h4>
      </div>
      <div class="modal-body">
        
	<?php

		if ( isset($_GET['orderId']) ) {
			$orderId = $_GET['orderId'];
			echo "order id :".$orderId;

		}

	?>	

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php require 'footer.php'; ?>
