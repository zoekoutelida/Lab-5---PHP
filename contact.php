<!doctype HTML>

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
	
	<?php include("header.php")
	
	
	?>
	
<main>
             <div>

                <h3 class="contactus">Fill out the Contact form to send us any questions.</h3>
            
            <div class="containerform">
              <form action="/action_page.php">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="firstname" placeholder="Your name..">

                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="lastname" placeholder="Your last name..">

                <label for="subject">Message</label>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                <input type="submit" value="Submit">
              </form>
            </div>
        </div>
             
</main>
	
<?php include("footer.php") ?>
</body>


</html>

