  <!doctype html>

<?php
include ('config.php');

if(isset($_FILES['uploadFile'])){ //is someone clicks the upload button, do the following

$maxsize = 2000000;
$extensions = array('jpg', 'png', 'jpeg', 'gif');
$fileName = strtolower(substr($_FILES['uploadFile']['name'], strpos($_FILES['uploadFile']['name'], '.')+1));


$errors = array(); //places errors if upload doesn't work
	
if(in_array($fileName, $extensions) === false){ //checks if those extension exist in the array and are allowed
	$errors[] = "This extension is not allowed to upload!"; //if the extension doesn't exist - choose position [0]
	
}

if($_FILES['uploadFile']['size']>$maxsize){ //'size' is taken automatically from the image, no need to specify it anywhere
	$errors[] = "This file is too big!";
}
	
if(empty($error)){
	//if no errors upload the file
	
	
	move_uploaded_file($_FILES['uploadFile']['tmp_name'], "images/{$_FILES['uploadFile']['name']}");
		//moves uploaded file to a location - saves the files in "images" folder with the "name"
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
    <div class = "container">
		
		<?php
	if(isset($errors)){
		if(empty($errors)){
			echo '<p class="danger-text">'. "Files uploaded!" .'</p><br>';
		} else {
			foreach ($errors as $err){ //if many errors, echoes out all the errors
			echo '<p class="danger-text">'. $err .'</p><br>'; 
			}
		}
	}
	
	?>
		
	<form action="uploadfiles.php" method="post" enctype="multipart/form-data">
		<p id="upload">Select an image to upload:</p>
		<input type="file" name="uploadFile" id="uploadFile">
		<input type="submit" value="Upload Image" name="upload">
	</form>
	<p class="danger-text"><strong>Note: </strong>Only .jpg, .jpeg, .gif, .png files are allowed. Maximun size 2MB.</p>
	</div>
</body>

<?php include("footer.php") ?>


</html>