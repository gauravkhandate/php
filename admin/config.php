<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rangrasiareg";

// Create a connection to the database
$connection = mysqli_connect($servername, $username, $password, $dbname);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>