<?php
	include_once("../connection/dbconnect.php");
	global $connect;

	if(empty($_POST['firstname']) || empty($_POST['lastname'])|| empty($_POST['username'])|| empty($_POST['password'])|| empty($_POST['password2']) || empty($_POST['email']) )
	{
		$_SESSION['msg'] = '<div class="alert alert-danger">Please fill all fields.</div>';
		header("location:../register.php");
		die();
	}

	if($_POST['password'] != $_POST['password2'] )
	{
		$_SESSION['msg'] = '<div class="alert alert-danger">Password not match.</div>';
		header("location:../register.php");
		die();
	}

	if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['username'])&& isset($_POST['password'])&& isset($_POST['password2']) )
	{     
		$firstname = $_POST["firstname"];	
		$lastname = $_POST["lastname"];
		$username = $_POST["username"];
	    $password = $_POST["password"];
	    $email = $_POST["email"];
 
		$hashed = password_hash($password, PASSWORD_DEFAULT);
      
        $query = " Insert into users(firstname,lastname,username,password) values ('$firstname','$lastname','$username','$hashed');";
	
		mysqli_query($connect, $query) or die(mysqli_error($connect));
	
		mysqli_close($connect);
		$_SESSION['msg'] = '<div class="alert alert-danger">Please fill all fields.</div>';
		header("location:../index.php");
	}

?>	
