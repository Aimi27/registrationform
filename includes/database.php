<?php

//Params to connect to a database
$dbHost = "localhost"; // if hosting on web server, change it wherever the host is
$dbUser = "root";
$dbPass = "";
$dbName = "registrationdb";

//database connection
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);

//testing connection to db
// if condition refers to if connection is false/unsuccessful
if (!$conn) {
	die("Database connection failed!");
}
?>