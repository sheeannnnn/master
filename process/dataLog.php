<?php
	include_once("../connection/dbconnect.php");
	global $connect;


	$jsondata = file_get_contents("https://thingspeak.com/channels/344468/feeds/last.json");
	$data = json_decode($jsondata, true);
	// var_dump($data);
	$data = array_values($data);

	// var_dump($data[0]);
	// var_dump($data[1]);
	// var_dump($data[2]);
	$pressure = $data [0];
	$status = '';

	if( $pressure >= 100)
	{
		
		if ( $pressure > 600){
			$status = 'true';
		} elseif ($pressure < 600) {
			$status = 'false';
		}	
		

		$query = "Insert into history(pressure,status) values ('$pressure','$status');";

		mysqli_query($connect, $query) or die(mysqli_error($connect));
	}
		

?>
