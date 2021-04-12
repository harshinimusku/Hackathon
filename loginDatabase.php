<?php
//Styling for the website
echo "<link rel = 'stylesheet' type = 'text/css' href = 'sky.css'>";

// I am including the config file.
include_once 'config.php';
//I am recieving all the information from the form.
$username = $_POST['username'];
$password = md5($_POST['password']);
//Selecting the database
if (mysqli_select_db($conn, 'calendar'))
{
}
else
{
    // Creating the database if it does not exist.
    if (mysqli_query($conn, "CREATE DATABASE calendar"))
    {
    }
    else
    {
    }
}

//Selecting row based on the username.
$sql = "SELECT * FROM userINFO where username ='$username' ";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Checking conditions to assist the user if the password is incorrect.
if (mysqli_num_rows($result) > 0)
{
    if ($password==$row["password"]) 
    {
setcookie("username", $row["username"], time() + (86400 * 30), "/");
		echo $row["password"];
		header('Location: calendarPage.php');
        
    }
    else
    {
        echo "<br><h1>Wrong password. Please click <a href='login.html'>here</a> to log in again.</h1><p>If you are a first time user,please click <a href='register.html'>here</a> to register.</p>"; //Displays wrong password message
    }
}
else
{
    echo "<br><h1>Account does not exist. Please click <a href='register.html'>here</a> to register.</h1><p> If you would like to log in again. Please click <a href='login.html'>here</a>.</p>"; //Displays account not existing message
}
?>