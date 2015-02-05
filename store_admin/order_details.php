<?php 


require 'header.php'; 

// check if user has logged in /////
if ( !isUserLoggedIn() ) {
	header("Location: admin_login.php");
}


?>


<?php

	if ( isset($_GET['orderId']) ) {
		$orderId = isset($_GET['orderId']) ? $_GET['orderId'] : "";
		$orderDetailsTable = "shopcart_order_details";
		$queryOrderDetailsTable = "select * from ".$orderDetailsTable." where order_id = ".$orderId.";";
		$resultsOrderDetails = $db->query($queryOrderDetailsTable);

?>

		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading"><h4>Viewing order details for order number: <?php echo $orderId; ?></h4></div>

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
							//echo "<td>$dataForOrderDetails->date_added</td>";
							echo "<td>".date ('m-d-Y', strtotime($dataForOrderDetails->date_added))."</td>";
							echo "<td>$dataForOrderDetails->checkout_status</td>";
						echo "</tr>";



				}	

		    ?>
		  </table>
		</div>



	

		
<?php } //end if ?>	

<?php require 'footer.php'; ?>