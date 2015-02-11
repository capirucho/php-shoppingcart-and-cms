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




	$show_orderdetail_modal = false;

	if ( isset($_GET['orderId']) ) {
		$orderId = $_GET['orderId'];
		

		$orderDetailsTable = "shopcart_order_details";
		$queryOrderDetailsTable = "select * from ".$orderDetailsTable." where order_id = ".$orderId.";";
		$resultsOrderDetails = $db->query($queryOrderDetailsTable);

		$show_orderdetail_modal = true;

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
					echo "<td><a data-toggle=\"tooltip\" data-placement=\"right\" title=\"View order details\" id=\"$data->order_id\" href=\"order_details.php?orderId=".$data->order_id."\" class=\"order-id\">$data->order_id</a></td>";
					echo "<td>$data->order_status</td>";
					echo "<td>$data->customer_id</td>";
					echo "<td>$".$data->sub_total."</td>";
					echo "<td>$data->tax%</td>";
					echo "<td>$".$data->delivery_charge."</td>";
					echo "<td>$".$data->total."</td>";
				echo "</tr>";

			}
			$result->free();
			
		?>
	</table>
	
</section>


<div id="view-order-details" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><h4>Viewing order details for order number: <?php echo $orderId; ?></h4>
      </div>
      <div class="modal-body">
		  <!-- Table -->
		  <table class="table table-striped">

			<tr>
				<th>Product Name</th>
				<th>Unit Price</th>
				<th>Quantity</th>
				<th>Date Added</th>
				<th>Check Out Status</th>
			</tr>

		    <?php
				if ( $resultsOrderDetails->num_rows == 0 ) {
					echo "<tr>";
						echo "<td colspan=\"5\">0 results found</td>";
					echo "</tr>";
				}

				while ( $dataForOrderDetails = $resultsOrderDetails->fetch_object() ) {
						echo "<tr>";
							echo "<td>$dataForOrderDetails->product_name</td>";
							echo "<td>$".$dataForOrderDetails->unit_price."</td>";
							echo "<td>$dataForOrderDetails->quantity</td>";
							echo "<td>".date ('m-d-Y', strtotime($dataForOrderDetails->date_added))."</td>";
							echo "<td>$dataForOrderDetails->checkout_status</td>";
						echo "</tr>";



				}	
				$resultsOrderDetails->free();
		    ?>
		  </table>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if ( $show_orderdetail_modal ) { ?>

	<script>

		$('#view-order-details').modal('show');
		
	</script>
	
<?php } ?>

<?php 
	$db->close(); 
	require 'footer.php'; 
?>
