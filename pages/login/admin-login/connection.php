<?php
// Database connection parameters
$servername = "localhost"; // Change this to your database server name
$username = "d1rdrd"; // Change this to your database username
$password = "ubiuv.UV1!"; // Change this to your database password
$database = "ubiuv"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Close connection
$conn->close();
?>
