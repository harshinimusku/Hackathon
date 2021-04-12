<?php
	$servername ="localhost";
	$usern= "root";
	$password="";
	//Connects mysql
 	$conn = mysqli_connect($servername,$usern,$password);
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	} 
?>