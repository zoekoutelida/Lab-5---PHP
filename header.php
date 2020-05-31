<?php
	if(!isset($_SESSION))
		session_start();
	if(!empty($_SESSION['user'])){
		$logged_in_user = true;
		$is_staff = $_SESSION['is_staff'];
	} else {
		$logged_in_user = false;
		$is_staff = NULL;
	}
?>



<header class="site">
	

    <img src="bookreads_cover.png" alt="Home Cover" class="hometop">
    <nav id="topmenu">
                <ul class="nav">
                 <li> <a class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : NULL ?>" href="index.php">Home</a>
                 </li>
                    <li>
                        <a class="<?php echo ($current_page == 'about.php') ? 'active' : NULL ?>" href="about.php">About us</a>
                    </li>
                    <li>
                        <a class="<?php echo ($current_page == 'browse.php') ? 'active' : NULL ?>" href="browse.php">Browse Books</a>
                    </li>
                    <li>
                        <a class="<?php echo ($current_page == 'mybooks.php') ? 'active' : NULL ?>" href="mybooks.php">My Books</a>
                    </li>
					
					 <li>
                        <a class="<?php echo ($current_page == 'gallery.php') ? 'active' : NULL ?>" href="gallery.php">Gallery</a>
                    </li>
                    <li>
                        <a class="<?php echo ($current_page == 'contact.php') ? 'active' : NULL ?>" href="contact.php">Contact</a>
                    </li>
					
					<?php if ($_SESSION['is_staff']=="1"||$_SESSION['is_staff']=="2") {?>
					<li> <a class="<?php echo ($current_page == 'admin/admin_books.php') ? 'active' : NULL ?>" href="admin/admin_books.php">Admin books</a>
                 	</li>
	                <?php  } ?>
					
					<?php if ($_SESSION['is_staff']=="1") {?>
					<li> <a class="<?php echo ($current_page == 'admin/users.php') ? 'active' : NULL ?>" href="admin/users.php">Users</a>
                 	</li>
	                <?php  } ?>
					
                </ul>
            </nav>
</header>


<!---------
	<ul class="nav">
  <li <?php if ($_GET['pg'] == "PAGE1") { echo "class=\"active\""; } ?>><a href="?pg=PAGE1">FIRST PAGE</a></li>
  <li <?php if ($_GET['pg'] == "PAGE2") { echo "class=\"active\""; } ?>><a href="?pg=PAGE2">SECOND PAGE</a></li>
</ul>
------>