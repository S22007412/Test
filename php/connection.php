<?php
$serverName = "localhost";
$username = "d1rdrd";
$password = "ubiuv.UV1!";
$database = "ubiuv";

// Create connection
$conn = new mysqli($serverName, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . formatErrors($conn->connect_error));
}

function formatErrors($error)
{
    // Display errors
    echo "<h1>SQL Error:</h1>";
    echo "Error information: <br/>";
    echo "Message: " . $error . "<br/>";
}
?>
