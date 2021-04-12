<?php
//Styling for the website
// Including the config file.
include_once 'config.php';
//Recieving all the information from the form.
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$email = $_POST['email'];
$phoneNum = $_POST['phoneNumber'];

//Selecting the database
if (mysqli_select_db($conn, 'calendar'))
{
}
else
{
    // Creating the database if not already there.
    if (mysqli_query($conn, "CREATE DATABASE calendar"))
    {
    }
    else
    {
    }
}
//Creating a table if it doesn't exist.
$sql = "CREATE TABLE IF NOT EXISTS userINFO ( id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname VARCHAR(30) NOT NULL, lastname VARCHAR(30) NOT NULL, username VARCHAR(30) NOT NULL, password VARCHAR(1000) NOT NULL,email VARCHAR(1000) NOT NULL, start VARCHAR(30) NOT NULL,  stop VARCHAR(30) NOT NULL, notifications BOOLEAN NOT NULL, emailNotifications BOOLEAN NOT NULL, desktopNotifications BOOLEAN NOT NULL,sleepNotifications BOOLEAN NOT NULL, waterNotifications BOOLEAN NOT NULL)";

$result = mysqli_query($conn, $sql);

//Selecting rows to check if the username or the account already exists.
$sql = "SELECT * FROM userINFO where firstname ='$fname' AND lastname='$lname'";
$result = mysqli_query($conn, $sql);
$sql1 = "SELECT * FROM userINFO where username ='$username' ";
$result1 = mysqli_query($conn, $sql1);
//Checking the conditions and printing the according statements.
echo "<br><div>";
if (mysqli_num_rows($result) > 0)
{

    echo "An account with the same name already exists. Please login <a href='index.html'>here</a>.";

}
else if (mysqli_num_rows($result1) > 0)
{
    echo "An account with the same username already exists. Please register again <a href='register.html'>here</a>.";
}
else
{
    //Inserting values to the table from the form if all the conditions are passed.
    $sql = "INSERT INTO userINFO(firstname,lastname,username,password,email,start,stop,notifications,emailNotifications,desktopNotifications, sleepNotifications, waterNotifications) VALUES ('$fname','$lname','$username','$password', '$email', 'start', 'stop', 'false','false','false','false','false')";

    $result = mysqli_query($conn, $sql);
    echo "<p>Thank you for registering. Please click <a href='index.html'>here</a> to log in.</p>";
}
echo "</div>";

?>
