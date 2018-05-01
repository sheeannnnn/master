<?php
	include_once("connection/dbconnect.php");
	global $connect;

	$carcount = 0;
	$heavy = 0;
	$totalcar = 0;
	$triggercount = 0;
	
	if (mysqli_connect_errno()){
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}

	$test = "SELECT * from history order by id desc limit 3";
	$result=  mysqli_query($connect,$test);
	
	$array = array();

	while ($row = mysqli_fetch_assoc($result)){
		$array[] = $row;
	}
	
	// var_dump($array);

	foreach ($array as $item) {
			if($item['pressure'] >= 200  && $item['pressure'] <=300){
				$carcount++;
			}

			if ($item['pressure'] >=300 && $item['pressure'] <=500){
				$heavy++;
			}

			// if($item['pressure'] > 600){
			// 	$triggercount++;
			// } 

	}

	$totalcar += $carcount + $heavy;
	
?>