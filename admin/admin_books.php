<!doctype HTML>
<?php
include ('../config.php');
include ('functions.php');

//Open the database
@ $db = new mysqli($dbserver, $dbuser, $dbpasswd, $dbname);

//Check if problem connection
if($db->connect_error){
  echo "Sorry, you were not able to connect, because:" . $db->connect_error;
  exit();
}

$query = "SELECT books.ID, books.Title, books.ISBN, author.first_name, author.last_name, books.Publisher, books.Date FROM books
JOIN author_books ON books.ID = author_books.bookID
JOIN author ON author.ID = author_books.authorID";




$statement = $db->prepare($query);
$statement -> bind_result($ID, $title, $isbn, $author_first, $author_last, $publisher, $date);
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
	echo '<tr><td> Book ID </td><td>Title</td><td>Author</td><td>ISBN</td><td>Publisher</td><td>Date published</td><td>Action</td> </b> </tr>';
	while($statement->fetch()) {
		echo "<tr>";
		echo "<td> $ID </td><td> $title </td><td> $author_first $author_last </td><td> $isbn </td><br>
		<td> $publisher</td><td> $date</td>";
		
		echo "<td><a href=deletebook.php?id=".$ID." class=deletebook>Delete</a></td>";
		echo "</tr>";
		
	}
	echo "</table>";
	
	 
            echo'</tr>';

            echo '</table>'; 
	
	
	//INSERT INTO database new book
	
	
	

	?>
	
	<form id="addbooksform" action="functions.php" method = "POST">
			<div class="form-group">
                <label>Title</label>
                <input type="text" id="title" name="title" placeholder="Add book title" value="">
			</div>
			<div class="form-group">
                <label>Pages</label>
                <input type="text" id="pages" name="pages" placeholder="Add page amount" value="">
			</div>
			<div class="form-group">
                <label>ISBN</label>
                <input type="text" id="isbn" name="isbn" placeholder="Add ISBN" value="">
			</div>
			<div class="form-group">
                <label>Publication Date</label><br><p></p>
                <input type="date" id="date" name="date" placeholder="Date publishes" value="">
			</div><p></p>
		
			<div class="form-group">
                <label>Author</label>
				<?php
				$resultSet = $db->query("SELECT id, first_name, last_name FROM author");
				?>
				<select name="authors">
				 <option value="">Select Author</option> 
				<?php 
					while($rows = $resultSet->fetch_assoc()){
					$authorid = $rows['id'];
					$first_name = $rows['first_name'];
					$last_name = $rows['last_name'];
					echo "<option value='" .$authorid. "'>$authorid $first_name $last_name</option>";
				}
					?>
				</select>
			</div>
		
			<div class="form-group">
                <label>Publisher</label>
				<?php
				$resultSet = $db->query("SELECT publisher_name FROM publisher");
				?>
				<select name="publisher">
				 <option value="">Select Publisher</option> 
				<?php 
					while($rows = $resultSet->fetch_assoc()){

					$publisher = $rows['publisher_name'];
					echo "<option value='$publisher'>$publisher</option>";
				}
					?>
				</select>
			</div>
		
            <div class="form-group">
				<button type="submit" class="btn" name="add_book_btn">Add book</button>
			</div>
 	 </form>
	
    

<?php include("../footer.php") ?>
</body>




</html>