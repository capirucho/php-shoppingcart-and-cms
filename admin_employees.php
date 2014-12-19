<?php require 'header.php'; ?>


<section id="employees">
	<h2>Employees</h2>
	<table id="employee_list">
		<tr>
			<th>Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
		</tr>
		<?php 

			$table_name = "shopcart_admin_employees";
			$command = "select * from ".$table_name." order by username desc";
			$result = $db->query($command);		

			while ( $data = $result->fetch_object() ) { 
				print "<tr><td>$data->last_name</td><td>$data->first_name</td><td>$data->username</td><td>$data->email_address</td></tr>";
			}
			$result->free();
			$db->close();
		?>
	</table>
	
</section>


<?php require 'footer.php'; ?>