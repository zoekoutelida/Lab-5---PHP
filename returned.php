<!doctype html>

<?php
include ('config.php');
?>

<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>



<body class="site">
	
	<?php include("header.php") ?>
    
		<h1>Your book has been returned. <br>Thank you!</h1>
     <?php
	
	
	
	
	
	$ID = trim($_GET['ID']);
	
	echo "You are returning a book with ID: " .$ID;
	
	@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

	//Check if problem connection
	if($db->connect_error){
	  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
	  exit();
	}
		$query = "UPDATE books SET reserved = 0 WHERE ID = ?";  
	
		$statement = $db->prepare($query);
		$statement -> bind_param("i", $ID);
		$statement->execute();
	
			  
		
	
	?>
	
    
<?php include("footer.php") ?>
	
</body>

</html>
