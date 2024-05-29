<?php
include 'connection.php'; // Ensure this includes the correct connection details for MySQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_edificio = mysqli_real_escape_string($conn, $_POST['id_edificio']);
    $informacion = mysqli_real_escape_string($conn, $_POST['informacion']);

    // Prepare the SQL statement to update the information
    $sql = "UPDATE edificio SET historia='$informacion' WHERE id_edificio='$id_edificio'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect back to the main page
    if (isset($_SERVER['HTTP_REFERER'])) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
    } else {
        echo("chin no jaló");
        header("Location: testmodbdd.php");
    }
    exit();
}
?>