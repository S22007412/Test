<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // Start the session

include 'connection.php';

// Get the email and password from POST data
$email = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute the query for admin
$tsql = "SELECT * FROM administrador WHERE correo=? AND contraseña=?";
$stmt = $conn->prepare($tsql);

$_SESSION['retry'] = 'false';

if ($stmt) {
    // Bind parameters and execute for admin
    $stmt->bind_param("ss", $email, $pass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin found, set session type to 'admin'
        include 'set-session-admin.php';        
        exit();
    } else {
        // No admin found, check regular users
        $tsql2 = "SELECT * FROM usuario WHERE correo=? AND contraseña=?";
        $stmt2 = $conn->prepare($tsql2);
        if ($stmt2) {
            // Bind parameters and execute for user
            $stmt2->bind_param("ss", $email, $pass);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                // Regular user found, set session type to 'student'
                include 'set-session-student.php';
                exit();
            } else {
                // Neither admin nor regular user found
                $_SESSION['retry'] = 'true';
                header('Location: ../pages/login/index.php');
                exit();

            }
            $stmt2->close();
        } else {
            die("Failed to prepare user statement: " . $conn->error);
        }
    }

    // Close statement and result
    $stmt->close();
} else {
    die("Failed to prepare admin statement: " . $conn->error);
}

// Close connection
$conn->close();
?>
