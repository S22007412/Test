<?php
$serverName = "localhost";
$username = "d1rdrd";
$password = "ubiuv.UV1!";
$database = "ubiuv";

// Define the formatErrors function before it is used
// function formatErrors($error)
// {
//     // Display errors
//     echo "<h1>SQL Error:</h1>";
//     echo "Error information: <br/>";
//     echo "Message: " . $error . "<br/>";
// }

// Create connection
$conn = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . formatErrors($conn->connect_error));
}

//echo "Connected successfully";
?>