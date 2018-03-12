<?php
// database related info
	/*	 $host_name = "localhost";
		$host_username = "root";
		$host_password = "";
		$host_database = "thingspeak"; */
		
		 
		//1. connect database
		
		$conn = mysqli_connect($host_name, 
								$host_username, 
								$host_password, 
								$host_database);
		
		if(!$conn)
		{
			die("Database connection failed: " 
					. mysqli_error($conn) );
					echo "connection failed";
		}
?>