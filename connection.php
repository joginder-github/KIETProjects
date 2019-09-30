<?php
/*error_reporting(1);
mysqli_connect('localhost', 'root', '') or die(mysqli_error());
mysqli_select_db('poll') or die(mysqli_error());*/


		

		// Create connection
		$con = mysqli_connect('localhost', 'root','');

		// Check connection
		if (!$con) {
			die("Connection failed: " . mysqli_connect_error());
		}
		//echo "Connected successfully";
	    mysqli_select_db($con,'evote_database'); 
		
?>
