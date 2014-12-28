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

<section id="employees">
	<div class="clearfix">
		<h2>Current Admin Users</h2>
		<div class="add_employee"><button class="btn btn-default" type="button" data-toggle="modal" data-target="#addEmpForm">Add Employee</button></div>
	</div>
	<table id="employee_list" class="table table-striped">
		<tr>
			<th>Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
		</tr>
		<?php 

			$table_name = "shopcart_admin_users";
			$command = "select * from ".$table_name." order by username asc;";
			$result = $db->query($command);		

			while ( $data = $result->fetch_object() ) { 
				print "<tr><td>$data->last_name</td><td>$data->first_name</td><td>$data->username</td><td>$data->email_address</td></tr>";
			}
			$result->free();
			$db->close();
		?>
	</table>
	
</section>


<div id="addEmpForm" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Add an Admin User</h4>
      </div>
      <div class="modal-body">
        

		<form role="form" action="admin_add_user.php" method="POST">
		  <div class="form-group">
		    <label for="userName">User Name</label>
		    <input name="username" type="text" class="form-control" id="username" placeholder="Enter Username (this will be your login name)">
		  </div>
		  <div class="form-group">
		    <label for="firstName">First Name</label>
		    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="Enter First Name">
		  </div>
		  <div class="form-group">
		    <label for="lastName">Last Name</label>
		    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Enter Last Name">
		  </div>		  		  		  
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
		  </div>
		  <div class="form-group">
		    <label for="UserEmail">Email address</label>
		    <input name="email_address" type="email" class="form-control" id="email_address" placeholder="Enter email">
		  </div>		  
		  <button type="submit" class="btn btn-success">Create an Admin User</button>
		</form>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php require 'footer.php'; ?>