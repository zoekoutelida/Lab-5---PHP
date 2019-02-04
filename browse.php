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
	
	$searchtitle = trim($_POST['title']);
	$searchauthor = trim($_POST['author']);
}


$query = "SELECT book.ID, book.Title, book.ISBN, author.first_name, author.last_name, book.reserved FROM book
JOIN author_book ON book.ID = author_book.bookID
JOIN author ON author.ID = author_book.authorID";

if ($searchtitle && !$searchauthor){
	
	$query = $query . " WHERE book.Title LIKE '%" . $searchtitle . "%'";
}

if (!$searchtitle && $searchauthor){
	
	$query = $query . " WHERE author.first_name LIKE '%" . $searchauthor . "%'";
}

if ($searchtitle && $searchauthor){
	
	$query = $query . " WHERE book.Title LIKE '%" . $searchtitle . "%' AND author.first_name LIKE '%" . $searchauthor . "%";
}
	
echo $query;


$statement = $db->prepare($query);
$statement -> bind_result($ID, $title, $isbn, $author_first, $author_last, $reserved);
$statement->execute();

/*if (available($statement)){
	reserve();
}*/



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
                <input type="text" id="author" name="author" placeholder="ex. Jo Nesbo">

                <label for="last_name">Book title</label>
                <input type="text" id="title" name="title" placeholder="ex. Macbeth">

                <input type="submit" name="submit" value="Submit">
              </form>
            </div>
	<?php
	
	echo '<table cellpadding="6">';
	echo '<tr><td> Book ID </td><td>Title</td><td>Author</td><td>ISBN</td><td>Reserved</td> </b> </tr>';
	while($statement->fetch()) {
		if ($reserved==0){
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
	<!-----
      <div>
      	<ul>
      		<li>Blue Monday - Nicci French<button class="reserve_book">Reserve</button></li>
      		<li>Snowman - Jo Nesbo<button class="reserve_book">Reserve</button></li>
      		<li>The Shining - Stephen King<button class="reserve_book">Reserve</button></li>
      		<li>The girl in the woods - Camilla Lackberg<button class="reserve_book">Reserve</button></li>
      	</ul>

      </div>
		------------>
    

</body>

<?php include("footer.php") ?>



</html>