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

<section id="customers">
	<div class="clearfix">
		<h2>List of Customers</h2>
	</div>
	<table id="employee_list" class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Email</th>
			<th>Username</th>
			<th>Phone</th>
			<th>Address</th>
			<th>Credit Card Info</th>
		</tr>
		<?php 

			$customers_table = "shopcart_customer";
			$queryCustomerTable = "select * from ".$customers_table." order by last_name asc;";
			$resultsCustomerTable = $db->query($queryCustomerTable);	

			while ( $dataCustomerTable = $resultsCustomerTable->fetch_object() ) {
				$ccNum = 'XXXX-XXXX-XXXX-'.substr($dataCustomerTable->credit_card_number, -4);
				echo "<tr>";
					echo "<td>$dataCustomerTable->last_name, $dataCustomerTable->first_name</td>";
					echo "<td>$dataCustomerTable->email_address</td>";
					echo "<td>$dataCustomerTable->username</td>";
					echo "<td>$dataCustomerTable->phone</td>";
					echo "<td>$dataCustomerTable->address, $dataCustomerTable->city, $dataCustomerTable->state, $dataCustomerTable->zipcode</td>";
					echo "<td>$dataCustomerTable->credit_card_type,<br>$ccNum,<br>Exp. Date: $dataCustomerTable->credit_card_expiration_date</td>";
				echo "</tr>";

			}
			$resultsCustomerTable->free();
			$db->close();
		?>
	</table>
	
</section>


<?php require 'footer.php'; ?>
