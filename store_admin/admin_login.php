<?php require 'header.php'; ?>

<?php if ( isset($_GET['message']) ) {

   	echo "<div role=\"alert\" class=\"alert alert-danger\">".$_GET['message']."</div>";
}

?>


<section id="login_page">
	<h2>Login</h2>
	<form role="form" action="process_admin_login.php" method="post">
	  <div class="form-group">
	    <input name="username" type="text" class="form-control" id="username" placeholder="Username">
	  </div>
	  <div class="form-group">
	    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
	  </div>
	  <button type="submit" class="btn btn-default">Submit</button>
	</form>

</section>

<?php require 'footer.php'; ?>