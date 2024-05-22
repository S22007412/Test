<?php
include '../../../php/connection.php';

$email = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute the queries
$tsql = "SELECT * FROM administrador WHERE email=? AND pass=?";
$tsql2 = "SELECT * FROM usuario WHERE email=? AND pass=?";

$stmt = $conn->prepare($tsql);
$stmt2 = $conn->prepare($tsql2);

if ($stmt && $stmt2) {
    // Bind parameters and execute for administrador
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Bind parameters and execute for usuario
    $stmt2->bind_param("ss", $email, $pass);
    $stmt2->execute();
    $result2 = $stmt2->get_result();

    // Check results
    if ($result->num_rows > 0) {
        echo "<script>";
        echo "window.location = '../../admin/main/intro/index.html';";
        echo "</script>";
    } elseif ($result2->num_rows > 0) {
        echo "<script>";
        echo "window.location = '../../admin/main/intro/index.html';";
        echo "</script>";
    } else {
        echo "<script>";
        echo "alert('Usuario incorrecto');";
        echo "window.location = 'index.php';";
        echo "</script>";
    }

    // Free results and close statements
    $stmt->free_result();
    $stmt2->free_result();
    $stmt->close();
    $stmt2->close();
} else {
    die("Failed to prepare statements: " . formatErrors($conn->error));
}

// Close connection
$conn->close();

function formatErrors($error)
{
    // Display errors
    echo "<h1>SQL Error:</h1>";
    echo "Error information: <br/>";
    echo "Message: " . $error . "<br/>";
}
?>
