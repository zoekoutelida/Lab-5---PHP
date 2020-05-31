<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'book_club');

// variable declaration
$username = "";
$addbook = "";
$errors   = array(); 



if (isset($_POST['adduser_btn'])) {
	addUser();
}


function addUser(){
	
	global $db, $errors, $username, $user_first, $user_last, $email, $password, $is_staff;
	
	//define to escape values
	$username = mysqli_real_escape_string($db, trim($_POST['username']));
	$user_first = mysqli_real_escape_string($db, trim($_POST['user_first']));
	$user_last = mysqli_real_escape_string($db, trim($_POST['user_last']));
	$email = mysqli_real_escape_string($db, trim($_POST['email']));
	$is_staff = mysqli_real_escape_string($db, trim($_POST['is_staff']));
	$password_1 = mysqli_real_escape_string($db, trim($_POST['password_1']));

	$query = "INSERT INTO user (username, user_first, user_last, email, password, is_staff) 
					  VALUES('$username', '$user_first', '$user_last', '$email', '$password', '$is_staff')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: users.php');
			
			
		}


//-------------LOGIN

// call the login() function if user clicks login_btn
	if (isset($_POST['login_btn'])) {
	login();
	}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grab values from the form
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	// check that form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT userID,is_staff,username,password FROM user WHERE username='$username' AND password='$password'";
		$stmt= $db->prepare($query);
	     $stmt->bind_result($userID,$is_staff,$username,$password);
	     $stmt->execute();
		
		if ($stmt->fetch()>0){
	     	$_SESSION['username']=$username;
	     	$_SESSION['is_staff']=$is_staff;
	     	$_SESSION['userip']=$_SERVER['REMOTE_ADDR'];

	     	if ($_SESSION['is_staff']=="1") {
	     		header("location: admin/admin_index.php");//redirect
	     		
	     	}else if ($_SESSION['is_staff']=="2") {	
	     		header("location: admin/moderator_index.php");	

	     	}else if ($_SESSION['is_staff']=="0") {
	     		header("location:newupload.php");		

	     	}
	     } else{
	     		array_push($errors, "Something if wrong!");
	     	}
	}
}


if (isset($_POST['loginadmin_btn'])) {
	loginAdmin();
	}

//LOGIN ADMIN PANEL
function loginAdmin(){
	global $db, $username, $errors;

	
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT userID,is_staff,username,password FROM user WHERE username='$username' AND password='$password'";
		$stmt= $db->prepare($query);
	     $stmt->bind_result($userID,$is_staff,$username,$password);
	     $stmt->execute();
		
		if ($stmt->fetch()>0){
	     	$_SESSION['username']=$username;
	     	$_SESSION['is_staff']=$is_staff;
	     	$_SESSION['userip']=$_SERVER['REMOTE_ADDR'];

	     	if ($_SESSION['is_staff']=="1") {
	     		header("location: admin_index.php");
	     		
	     	}else if ($_SESSION['is_staff']=="2") {	
	     		header("location: moderator_index.php");	

	     	}else if ($_SESSION['is_staff']=="0") {
				
	     		array_push($errors, "Access not permitted!");		
			}
	     }else{
	     		array_push($errors, "Something if wrong!");
	     	}
	}
}

//IF ADD BOOK BUTTON CLICKED
if (isset($_POST['add_book_btn'])) {
	addBook();
}
//ADD BOOK
function addBook(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $title, $pages, $isbn, $date, $publisher, $bookid, $authorid;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$title    =  mysqli_real_escape_string($db, trim($_POST['title']));
	$pages  =  mysqli_real_escape_string($db, trim($_POST['pages']));
	$isbn  =  mysqli_real_escape_string($db, trim($_POST['isbn']));
	$date  =  mysqli_real_escape_string($db, trim($_POST['date']));
	$publisher  =  $_POST['publisher'];
	$authorid = $_POST['authors'];

	$sql = "INSERT INTO books (title, pages, isbn, date, publisher) 
					  VALUES('$title', '$pages', '$isbn', '$date', '$publisher')";
	$res = $db->query($sql);	
	
	$bookid = $db->insert_id;
	
	$author_book_query = "INSERT INTO author_books (authorID, bookID)
							VALUES('$authorid', '$bookid')";
	$res = $db->query($author_book_query);
	
	$_SESSION['success']  = "New book is successfully added!!";
			header('location: admin_books.php');
	
}

function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}
