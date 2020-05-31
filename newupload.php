  <!doctype html>

<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);


include ('config.php');
include ('admin/functions.php');

@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

if($db->connect_error){
  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
  exit();
}
//session_start();


if(isset($_POST['submit'])){
	
	$newFilename = $_POST['filename'];
	if(empty($newFilename)){
		$newFilename = "gallery";
	} else {
		$newFilename = strtolower(str_replace(" ", "-", $newFilename));
	}
	$imageTitle = htmlentities($_POST['filename']);
	$imageDesc = htmlentities($_POST['filedesc']);
	
	$file = $_FILES['file'];
	
	$fileName = $file["name"];
	$fileType = $file["type"];
	$fileTempName = $file["tmp_name"];
	$fileError = $file["error"];
	$fileSize = $file["size"];
	
	$fileExt = explode(".", $fileName); //an array to get the name of the file apart from the extension
	$fileActualExt = strtolower(end($fileExt));// make lowercase the extension of the uploaded file
	
	$extensions = array('jpg', 'png', 'jpeg', 'gif');
	
	//check for errors
	if (in_array($fileActualExt, $extensions)){//in_array checks if a specific string one of the indexes is inside a specific array
		if($fileError === 0){ //if no errors
			if($fileSize < 2000000)
			$imageFullName = $newFilename . "." . uniqid("", true) . "." . $fileActualExt;
			$fileDestination = "images/" . $imageFullName;
			
			if (empty($imageTitle) || empty($imageDesc)){
				header("Location: newupload.php?upload=empty");
				exit();
			} else{
				$sql = "SELECT * FROM images;";
				$stmt = mysqli_stmt_init($db);
				if (!mysqli_stmt_prepare($stmt, $sql)){ //if the statement not prepared, get error
					echo "SQL statement failed!";
				} else {
					mysqli_stmt_execute($stmt); //execute it in the website
					$result = mysqli_stmt_reset($stmt); //get result from statement
					$rowCount = mysqli_num_rows($result); // get number of rows of $result
					$setImageOrder = $rowCount + 1; //because no data now it will be 0 so we want it to be 1, adds 1 each time
					
					$sql = "INSERT INTO images (title, description, imgFullName, imgOrder) VALUES (?, ?, ?, ?);";
					if (!mysqli_stmt_prepare($stmt, $sql)){ //if the statement not prepared, get error
					echo "SQL statement failed!";
				} else {
						mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullName, $setImageOrder);
						mysqli_stmt_execute($stmt);
						
						move_uploaded_file($fileTempName, $fileDestination);
						
						header("Location: newupload.php?upload=success");
						
					}
				}
			}
		} else {
		echo "File size too big";
		exit();
	}
		} else {
		echo "This extension is not allowed to upload!";
		exit();
	}
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
    
<section class="gallery-links">
	
		<h2>Upload an image</h2>
			<?php
		
				echo '<div class="gallery-upload">
				<form action="newupload.php" method="post" enctype="multipart/form-data">
					<p id="upload">Select an image to upload:</p>
					<input type="text" name="filename" placeholder="Add title">
					<input type="text" name="filedesc" placeholder="Add file description">
					<input type="file" name="file">
					<button type="submit" name="submit">Upload</button>
				</form>
				<p class="danger-text"><strong>Note: </strong>Only .jpg, .jpeg, .gif, .png files are allowed. Maximun size 2MB.</p>
			</div>';
			?>
	
	
	<h2>Images uploaded in gallery</h2>
	<div class="gallery-container">
		
		
			<?php
	
			//include_once 'config.php';
			//$db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);
	
			$sql = "SELECT * FROM images ORDER BY imgOrder DESC";
			$stmt = mysqli_stmt_init($db);
			if (!mysqli_stmt_prepare($stmt, $sql)){
				echo "SQL statement failed!";
			} else {
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				
				while ($row = mysqli_fetch_assoc($result)){ //loop through the rows
					
					
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