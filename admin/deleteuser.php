<?php

$db = mysqli_connect('localhost', 'root', '', 'book_club');
		
			$delete_user = "DELETE FROM user WHERE user.userID='$_GET[id]'";
			
			$res = $db->query($delete_user);

			header('location: users.php');
			

?>