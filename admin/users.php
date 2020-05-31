<!doctype HTML>
<?php
include ('../../config.php');
include ('functions.php');

//Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

//Check if problem connection
if($db->connect_error){
  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
  exit();
}

$query = "SELECT user.userID, user.username, user.user_first, user.user_last, user.email FROM user";




$statement = $db->prepare($query);
$statement -> bind_result($userID, $username, $user_first, $user_last, $email);
$statement->execute();



?>



<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>



<body class="site">
	
    <?php include("admin_header.php") ?>
	
		
	<?php
	
	
	echo '<table cellpadding="6" id="adminbooks">';
	echo '<tr><td> User ID </td><td>Username</td><td>Name</td><td>Email</td><td>Action</td> </b> </tr>';
	while($statement->fetch()) {
		echo "<tr>";
		echo "<td> $userID </td><td> $username </td><td> $user_first $user_last </td><td> $email </td>";
		
		echo "<td><a href=deleteuser.php?id=".$userID." class=deleteuser>Delete user</a></td>";
		echo "</tr>";
		
	}
	echo "</table>";
	
	 
            echo'</tr>';

            echo '</table>'; 
	
	

	?>
	
	<h2>Add new user</h2>
	
	<form id="adduserform" action="users.php" method = "POST">
		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="">
		</div>
		<div class="input-group">
			<label>First name</label>
			<input type="text" name="user_first" value="">
		</div>
		<div class="input-group">
			<label>Last name</label>
			<input type="text" name="user_last" value="">
		</div>
		<div class="input-group">
			<label>Email</label>
			<input type="text" name="email" value="">
		</div>
		<div class="input-group">
			<label>User type</label>
			<input type="text" name="is_staff" placeholder="Add a number: 0=user  1=admin  2=moderator">
		</div>
		<div class="input-group">
			<label>Password</label>
			<input type="password" name="password_1">
		</div>
	<div class="input-group">
		<button type="submit" class="btn" name="adduser_btn">Add user</button>
	</div>
 	 </form>
	
    

<?php include("../footer.php") ?>
</body>


</html>