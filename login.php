  <!doctype html>

<?php
include ('config.php');
include('admin/functions.php');
			
		?>

<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>



<body class="site">
	<img src="bookreads_cover.png" alt="Home Cover" class="hometop">
	<h1>Book club login</h1>
    
	<form id="loginform" method="post" action="login.php">

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
			<button type="submit" class="btn" name="login_btn">Login</button>
		</div>
	</form>

	
</body>


</html>