<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connection.php';

// Get the email and password from POST data
$email = $_POST['username'];
$pass = $_POST['password'];

// Prepare and execute the query for admin
$tsql = "SELECT * FROM admin WHERE email=? AND pass=?";
$stmt = $conn->prepare($tsql);

if ($stmt) {
    // Bind parameters and execute for admin
    $stmt->bind_param("ss", $email, $hashedPass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin found, redirect to admin page
        header("Location: ../pages/admin/main/intro/index.php");
        exit();
    } else {
        // No admin found, check regular users
        $tsql2 = "SELECT * FROM users WHERE email=? AND pass=?";
        $stmt2 = $conn->prepare($tsql2);
        if ($stmt2) {
            // Bind parameters and execute for user
            $stmt2->bind_param("ss", $email, $hashedPass);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                // Regular user found, redirect to user page
                header("Location: ../pages/admin/main/interactive-map/index.php");
                exit();
            } else {
                // Neither admin nor regular user found
                echo "<script>";
                echo "alert('Usuario incorrecto');";
                echo "window.location = './pages/login/admin-login/index.php';";
                echo "</script>";
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

function formatErrors($error)
{
    // Log or handle errors more gracefully
    return $error;
}
?>
