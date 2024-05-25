<?php
include 'connection.php'; // Ensure this includes the correct connection details for MySQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_edificio = mysqli_real_escape_string($conn, $_POST['id_edificio']);
    $id_salon = mysqli_real_escape_string($conn, $_POST['id_salon']);
    $informacion = mysqli_real_escape_string($conn, $_POST['informacion']);

    // Prepare the SQL statement to update the information
    $sql = "UPDATE salon SET informacion='$informacion' WHERE id_edificio='$id_edificio' AND id_salon='$id_salon'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);

    // Redirect back to the main page
    header("Location: ../tests/testmodbdd.php");
    exit();
}
?>
