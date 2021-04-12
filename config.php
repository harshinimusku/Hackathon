<?php
	$servername ="localhost";
	$username= "root";
	$password="";
	//Connects mysql
 	$conn = mysqli_connect($servername,$username,$password);
	if(!$conn){
		die("Connection failed: " . mysqli_connect_error());
	} 
?>