<?php

$db = mysqli_connect('localhost', 'root', '', 'book_club');
		
			$delete_book = "DELETE FROM books WHERE books.id='$_GET[id]'";
			
			$res = $db->query($delete_book);

			$delete_author_book = "DELETE FROM author_books WHERE author_books.bookID='$_GET[id]'";
			
			$res = $db->query($delete_author_book);

			header('location: admin_books.php');
			

?>