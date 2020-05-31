<!doctype HTML>
<?php
include ('config.php');

//Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

//Check if problem connection
if($db->connect_error){
  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
  exit();
}

//isset means if this has been activated
//&_POST is a global variable, to see if the Search btn has been clicked
// 26 min

$searchtitle = '';
$searchauthor = '';
if(isset($_POST) && !empty($_POST)){
	
	$searchtitle = htmlentities(trim($_POST['title']));
	$searchauthor = htmlentities(trim($_POST['author']));
}


$query = "SELECT books.ID, books.Title, books.ISBN, author.first_name, author.last_name, books.reserved FROM books
JOIN author_books ON books.ID = author_books.bookID
JOIN author ON author.ID = author_books.authorID";

if ($searchtitle && !$searchauthor){
	
	$query = $query . " WHERE books.Title LIKE '%" . $searchtitle . "%'";
}

if (!$searchtitle && $searchauthor){
	
	$query = $query . " WHERE author.first_name LIKE '%" . $searchauthor . "%'";
}

if ($searchtitle && $searchauthor){
	
	$query = $query . " WHERE books.Title LIKE '%" . $searchtitle . "%' AND author.first_name LIKE '%" . $searchauthor . "%";
}
	



$statement = $db->prepare($query);
$statement -> bind_result($ID, $title, $isbn, $author_first, $author_last, $reserved);
$statement->execute();



?>



<html>

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
</head>



<body class="site">
	
    <?php include("header.php") ?>
	
		<h1>Search for books</h1>
     <div class="containerform">
              <form action="" method = "post">
                <label for="first_name">Author</label>
                <input type="text" id="author" name="author" placeholder="Author of the book">

                <label for="last_name">Book title</label>
                <input type="text" id="title" name="title" placeholder="Title of the book">

                <input type="submit" name="submit" value="Submit">
              </form>
            </div>
	<?php
	
	echo '<table cellpadding="6">';
	echo '<tr><td> Book ID </td><td>Title</td><td>Author</td><td>ISBN</td><td>Reserved</td><td>Action</td> </b> </tr>';
	while($statement->fetch()) {
		if ($reserved==0 || $reserved==1 ){
		echo "<tr>";
		echo "<td> $ID </td><td> $title </td><td> $author_first $author_last </td><td> $isbn </td><td> $reserved</td>";
		echo '<td><a href="reserved.php?ID='.urlencode($ID). '"> Reserve </a></td>';
		echo "</tr>";
		}
	}
	echo "</table>";
	
	
	
            echo'</tr>';

            echo '</table>'; 

	?>
	
	
<?php include("footer.php") ?>

</body>


</html>