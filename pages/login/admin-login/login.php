<?php
include '../../../php/connection.php';

$email = $_POST['username'];
$pass = $_POST['password'];

$tsql = "SELECT * FROM admin WHERE email=$email AND pass=$pass";
$tsql2 = "SELECT * FROM usuario WHERE email=$pass AND pass=$pass";

// Prepare and execute first query
$stmt = $conn->prepare($tsql);
$stmt->bind_param("ss", $email, $pass);
$stmt->execute();
$result = $stmt->get_result();

// Prepare and execute second query if first query has no rows
$stmt2 = $conn->prepare($tsql2);
$stmt2->bind_param("ss", $email, $pass);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result === false && $result2 === false) {
    die(formatErrors($conn->error));
}

if ($result->num_rows > 0) {
    echo "<script>";
    echo "window.location = '../../admin/main/intro/index.html';";
    echo "</script>";
} else if ($result2->num_rows > 0) {
    echo "<script>";
    echo "window.location = '../../admin/main/interactive-map/index.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Usuario incorrecto');";
    echo "window.location = 'index.php';";
    echo "</script>";
}

$stmt->close();
$stmt2->close();
$conn->close();

function formatErrors($error)
{
    // Display errors
    echo "<h1>SQL Error:</h1>";
    echo "Error information: <br/>";
    echo "Message: " . $error . "<br/>";
}
?>
