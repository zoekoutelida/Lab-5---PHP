<?php include('functions.php') 




?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<div class="header">
		<h2>Admin Login</h2>
	</div>
	<form id="loginform" method="post" action="admin_login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="loginadmin_btn">Login</button>
		</div>
	</form>
	

</body>
</html>