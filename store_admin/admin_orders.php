<?php 


require 'header.php'; 

// check if user has logged in /////
if ( !isUserLoggedIn() ) {
	header("Location: admin_login.php");
}


?>

<?php 

	$orders_table = "shopcart_orders";
	$customer_table = "shopcart_customer";

	$ordersQuery = "select order_id, order_status, ".$orders_table.".customer_id, first_name, last_name, sub_total, tax, delivery_charge, total from "
	.$orders_table." left outer join ".$customer_table." on ".$orders_table.".customer_id = ".$customer_table.".customer_id order by ".$orders_table.".order_id;";

	$resultOrdersQuery = $db->query($ordersQuery);

	if ( isset($_GET['foundUserName']) ) {
		echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['foundUserName']."</div>";
	}

	if ( isset($_GET['userAdded']) ) {
		echo "<div role=\"alert\" class=\"alert alert-success\">".$_GET['userAdded']."</div>";
	}



	$show_details_modal = false;

	if ( isset($_GET['orderId']) ) {
		$orderId = $_GET['orderId'];
		

		$orderDetailsTable = "shopcart_order_details";
		$queryOrderDetailsTable = "select * from ".$orderDetailsTable." where order_id = ".$orderId.";";
		$resultsOrderDetails = $db->query($queryOrderDetailsTable);

		$show_details_modal = true;

	}


	if ( isset($_GET['showCustomerDetail']) ) {
		$detailCustomerId = $_GET['showCustomerDetail'];
		
		$queryCustomerDetails = "select * from ".$customer_table." where customer_id = ".$detailCustomerId.";";
		$resultsCustomerDetails = $db->query($queryCustomerDetails);

		$show_details_modal = true;

	}	


?>

<section id="orders">
	<div class="clearfix">
		<h2>Current Orders</h2>
	</div>
	<table id="employee_list" class="table table-striped">
		<tr>
			<th>Order Id</th>		
			<th>Customer Name</th>
			<th>Sub Total</th>
			<th>Tax</th>
			<th>Delivery Charge</th>
			<th>Total</th>
			<th>Order Status</th>
		</tr>
		<?php 

			while ( $dataOrders = $resultOrdersQuery->fetch_object() ) {

				echo "<tr>";
					echo "<td><a data-toggle=\"tooltip\" data-placement=\"right\" title=\"View order details\" id=\"$dataOrders->order_id\" href=\"order_details.php?orderId=".$dataOrders->order_id."\" class=\"order-id\">$dataOrders->order_id</a></td>";					
					echo "<td><a href=\"order_details.php?custId=$dataOrders->customer_id\" class=\"customer-name\">$dataOrders->last_name, $dataOrders->first_name</a></td>";
					echo "<td>$".$dataOrders->sub_total."</td>";
					echo "<td>$dataOrders->tax%</td>";
					echo "<td>$".$dataOrders->delivery_charge."</td>";
					echo "<td>$".$dataOrders->total."</td>";
					echo "<td>$dataOrders->order_status</td>";
				echo "</tr>";

			}
			$resultOrdersQuery->free();
			
		?>
	</table>
	
</section>


<div id="view-details" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">
        	<?php if ( isset($_GET['orderId']) ) { ?>
        		Viewing order details for order number: <?php echo $orderId; ?>
        	<?php } ?>
        	<?php if ( isset($_GET['showCustomerDetail']) ) { ?>
        		Viewing Customer Details
        	<?php } ?>

        </h4>
      </div>
      <div class="modal-body">
      	<?php if ( isset($_GET['orderId']) ) { ?>
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
							echo "<td>".$dataForOrderDetails->quantity."</td>";
							echo "<td>".date ('m-d-Y', strtotime($dataForOrderDetails->date_added))."</td>";
							echo "<td>".$dataForOrderDetails->checkout_status."</td>";
						echo "</tr>";



				}	
				$resultsOrderDetails->free();
		    ?>
		  </table>
		 <?php } ?>

		 <?php if ( isset($_GET['showCustomerDetail']) ) { ?>
			 <?php
				if ( $resultsCustomerDetails->num_rows == 0 ) {
					echo "<div class=\"list-group\">";
						echo "<div class=\"list-group-item\">";
							echo "<h4 class=\"list-group-item-heading\">0 results found</h4>";
						echo "</div>";
					echo "</div>";
				}

				while ( $dataCustomerDetails = $resultsCustomerDetails->fetch_object() ) {
						$ccNum = 'XXXX-XXXX-XXXX-'.substr($dataCustomerDetails->credit_card_number, -4);
						echo "<div class=\"list-group\">";
							echo "<div class=\"list-group-item\">";
								echo "<h4 class=\"list-group-item-heading\">Name</h4>";
								echo "<p class=\"list-group-item-text\">$dataCustomerDetails->last_name, $dataCustomerDetails->first_name<br>Username: $dataCustomerDetails->username</p>";
							echo "</div>";
							echo "<div class=\"list-group-item\">";
								echo "<h4 class=\"list-group-item-heading\">Contact Info</h4>";
								echo "<p class=\"list-group-item-text\">email: $dataCustomerDetails->email_address<br>phone: $dataCustomerDetails->phone<br>address: $dataCustomerDetails->address $dataCustomerDetails->city, $dataCustomerDetails->state, $dataCustomerDetails->zipcode</p>";
							echo "</div>";
							echo "<div class=\"list-group-item\">";
								echo "<h4 class=\"list-group-item-heading\">Payment Info</h4>";
								echo "<p class=\"list-group-item-text\">credit card: $dataCustomerDetails->credit_card_type<br>cc number: $ccNum<br>cc expiration date: $dataCustomerDetails->credit_card_expiration_date</p>";
							echo "</div>";							
						echo "</div>";



				}	
				$resultsCustomerDetails->free();
			?>

		 <?php } ?>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php if ( $show_details_modal ) { ?>

	<script>

		$('#view-details').modal('show');
		
	</script>
	
<?php } ?>







<?php 
	$db->close(); 
	require 'footer.php'; 
?>
