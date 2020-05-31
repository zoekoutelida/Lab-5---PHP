  <!doctype html>
<?php
include ('config.php');
include ('admin/functions.php');

@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

if($db->connect_error){
  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
  exit();
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
    

	<div class="galleryimages">
		<h2>Gallery</h2>
		<div class="gallery-container">
			<?php
	
			include_once 'config.php';
			$db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);
	
			$sql = "SELECT * FROM images ORDER BY imgOrder DESC";
			$stmt = mysqli_stmt_init($db);
			if (!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL statement failed!";
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				
				while ($row = mysqli_fetch_assoc($result)){
					
					
					echo '<a href="#" class="gallery">
							<div><img src="images/'.$row["imgFullName"].'" width="300"></div>
							<h3>'.$row["title"].'</h3>
							<p>'.$row["description"].'</p>
						  </a>';
					
				}
			}
			
	
			
			?>
		</div>
	
	</section>

		
		
	
<?php include("footer.php") ?>
</body>



</html>