<?php
	
		include_once 'config.php';
		$username = 'placeholder';
		$eventDate = $_GET['eDate'];
		$eventName = $_GET['eName'];
		$details = $_GET['eDesc'];
		$journal = $_GET['journal'];
		
//Selecting the database
		if (mysqli_select_db($conn, 'calendar'))
		{
		}
		else
		{
	//Creating the database if not already there.
		    if (mysqli_query($conn, "CREATE DATABASE calendar"))
		   {
		   }
		}
		//Creating a table if it doesn't exist.
		$sql = "CREATE TABLE IF NOT EXISTS calendarINFO ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, username VARCHAR(30) NOT NULL, eventDate VARCHAR(30) NOT NULL, eventName VARCHAR(30) NOT NULL, details VARCHAR(1000) NOT NULL,journal VARCHAR(10000) NOT NULL)";

		$result = mysqli_query($conn, $sql);

		$sql = "INSERT INTO calendarINFO (username,eventDate,eventName,details,journal) VALUES ('$username','$eventDate','$eventName','$details', '$journal')";

		$result = mysqli_query($conn, $sql);
		header("Location: calendar.php");
?>
