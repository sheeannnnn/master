<?php
include('connection/dbconnect.php');
	if(isset($_GET['home'])){
		header("location:admin.php");
	}
	
	else{
		if(isset($_GET['logout'])){
		echo ("<script LANGUAGE='JavaScript'>
			    window.alert('You have been logged out.');
			    </script>");
		session_destroy();
		header("location:index.php"); }
	
	}
	
?>