<?php
include '../../../php/connection.php';

// Get the POST data
$email = $_POST['username'];
$pass = $_POST['password'];

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the statements to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM administrador WHERE email=? AND pass=?");
$stmt->bind_param("ss", $email, $pass);

$stmt2 = $conn->prepare("SELECT * FROM usuario WHERE email=? AND pass=?");
$stmt2->bind_param("ss", $email, $pass);

// Execute the statements
$stmt->execute();
$result = $stmt->get_result();

$stmt2->execute();
$result2 = $stmt2->get_result();

// Check if rows exist in either query
if ($result->num_rows > 0) {
    echo "<script>";
    echo "window.location = '../../admin/main/intro/index.html';";
    echo "</script>";
} else if ($result2->num_rows > 0) {
    echo "<script>";
    echo "window.location = '../../admin/main/intro/index.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Usuario incorrecto');";
    echo "window.location = 'index.php';";
    echo "</script>";
}

// Close the statements and the connection
$stmt->close();
$stmt2->close();
$conn->close();
?>
