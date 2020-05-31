<?php
	if(!isset($_SESSION))
		session_start();
	if(!empty($_SESSION['user'])){
		$logged_in_user = true;
		$is_staff = $_SESSION['is_staff'];
	} else {
		$logged_in_user = false;
		$is_staff = NULL; //not logged in
	}

?>


<header class="site">
	

    <img src="../bookreads_cover.png" alt="Home Cover" class="hometop">
    <nav id="topmenu">
                <ul class="nav">
                 <li> <a class="<?php echo ($current_page == 'admin_index.php' || $current_page == '') ? 'active' : NULL ?>" href="admin_index.php">Home</a>
                 </li>
					<?php if ($_SESSION['is_staff']=="1"||$_SESSION['is_staff']=="2") {?>
					<li> <a class="<?php echo ($current_page == 'admin_books.php') ? 'active' : NULL ?>" href="admin_books.php">Admin books</a>
                 	</li>
	                <?php  } ?>
					
					<?php if ($_SESSION['is_staff']=="1") {?>
					<li> <a class="<?php echo ($current_page == 'users.php') ? 'active' : NULL ?>" href="users.php">Users</a>
                 	</li>
	                <?php  } ?>
				
					
				 <li>
					<a class="<?php echo ($current_page == '../gallery.php') ? 'active' : NULL ?>" href="../gallery.php">Gallery</a>
					</li>
					
					<li>
					<a class="<?php echo ($current_page == '../newupload.php') ? 'active' : NULL ?>" href="../newupload.php">Upload files</a>
					</li>
					
                </ul>
            </nav>
</header>
