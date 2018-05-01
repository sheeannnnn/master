<?php
include_once('connection/dbconnect.php');

$username="";
$password="";
$type="";
$msg="";

	if(empty($_POST['username']) && empty($_POST['password']))
	{
		$_SESSION['msg'] = '<div class="alert alert-danger">Please fill all fields.</div>';
		header("location:index.php");
		die();
	}
	else{

		date_default_timezone_set('Asia/Singapore');
		$lastlogin = date('m/d/Y h:i:s a', time());

		$username= $_POST['username'];
		$password= $_POST['password'];

	  	$query = "SELECT * FROM users WHERE username='$username'";
      	$result = mysqli_query($connect, $query);
      	$rows = mysqli_fetch_array($result);
      	$num_rows = mysqli_num_rows($result);
      	$verify = password_verify($_POST['password'],$rows['password']);

      	if ($num_rows>0){
      		if ($verify){
     		$_SESSION['username'] = $username;
     		 echo ("<script LANGUAGE='JavaScript'>
	   				window.alert('Logged in successfully.');
	    			window.location.href='admin.php';
	    			</script>");
             mysqli_close($connect);      
     		} 
	     	else {
	     		$_SESSION['msg'] = '<div class="alert alert-warning">Wrong Password.</div>';
				header("location:index.php");
				die();
	     	}
      	}
      	else{
      		$_SESSION['msg'] = '<div class="alert alert-warning">Invalid username and password.</div>';
			header("location:index.php");
			die();
      	}
     	

    }	
?>