  <!doctype html>

<?php
include ('config.php');


@ $db = mysqli_connect($dbserver, $dbuser, $dbpasswd, $dbname);

	//Check if problem connection
	if($db->connect_error){
	  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
	  exit();
	}
		
	
		if(isset($_POST) && !empty($_POST)){
			
			$myusername = mysqli_real_escape_string($db, $_POST['username']);
			$mypassword = mysqli_real_escape_string($db, $_POST['password']);
			// ' OR'1'='1'

			//$username = trim($_POST['username']);
			//$password = trim($_POST['password']);
			$query="SELECT user.username, user.password FROM user
			WHERE username ='".$myusername."' ";
			$stmt = $db->prepare ($query);
			//the following statement replaces the "?" inside the sql prepared statement
			 //this says it's a string, and the value is whatever inside the $myusername
			$stmt->bind_result($dbuser, $dbpasswd);
			$stmt->execute();
			
			//check if the password is the same with a "while" statement, so we ask the DB ifthere is a username with that name to search for the password, otherwise don't check
			while($stmt->fetch()){
				if(md5($mypassword) == $dbpasswd){
					header("location:uploadfiles.php");
				} echo "Wrong password!";
				
			}
			//use MD5  only if the password inside the DB is already hashed, if it's just text you don't need it
		}
			
		?>

<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>



<body class="site">
	
	<?php include("header.php") ?>
    
	<form id="loginform" action="#" method="POST">
      <label for="username"><b>Username</b></label>
      	<input type="text" placeholder="Enter Username" name="username" required>

      <label for="password"><b>Password</b></label>
      	<input type="password" placeholder="Enter Password" name="password" required>
        
      <button type="submit" name="submit" value="LOGIN">Login</button>
		 <!------- <label>
			<input type="checkbox" checked="checked" name="remember"> Remember me
		  </label> ---------->
    </form>

	
</body>

<?php include("footer.php") ?>


</html>