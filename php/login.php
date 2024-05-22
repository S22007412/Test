<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


include 'connection.php';

// Assuming email is unique, let's use it for authentication
$email = $_POST['username'];
$pass = $_POST['password'];

// Hash the provided password for comparison
$hashedPass = hash('sha256', $pass);

// Prepare and execute the query
$tsql = "SELECT * FROM admin WHERE email=? AND pass=?";
$stmt = $conn->prepare($tsql);

if ($stmt) {
    // Bind parameters and execute
    $stmt->bind_param("ss", $email, $hashedPass);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Admin found, redirect to admin page
        header("Location: ../../admin/main/intro/index.html");
        exit();
    } else {
        // No admin found, check regular users
        $tsql2 = "SELECT * FROM usuario WHERE email=? AND pass=?";
        $stmt2 = $conn->prepare($tsql2);
        if ($stmt2) {
            // Bind parameters and execute for user
            $stmt2->bind_param("ss", $email, $hashedPass);
            $stmt2->execute();
            $result2 = $stmt2->get_result();

            if ($result2->num_rows > 0) {
                // Regular user found, redirect to user page
                header("Location: ../../user/main/index.html");
                exit();
            } else {
                // Neither admin nor regular user found
                echo "<script>";
                echo "alert('Usuario incorrecto');";
                echo "window.location = 'index.php';";
                echo "</script>";
            }
            $stmt2->close();
        } else {
            die("Failed to prepare user statement: " . formatErrors($conn->error));
        }
    }

    // Close statement and result
    $stmt->close();
} else {
    die("Failed to prepare admin statement: " . formatErrors($conn->error));
}

// Close connection
$conn->close();
?>
