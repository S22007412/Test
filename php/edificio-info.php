<?php
include 'connection.php'; // Ensure this includes the correct connection details for MySQL

// Assuming you have variables $id_edificio and $id_salon defined somewhere earlier

// Prepare the SQL statement
$id_edificio = mysqli_real_escape_string($conn, $id_edificio);
$sql = "SELECT historia FROM edificio WHERE id_edificio='$id_edificio'";

// Execute the query
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$row = mysqli_fetch_assoc($result);
$informacion = $row['historia'];

// Echo the result
echo $informacion;

// Free the result and close the connection
mysqli_free_result($result);
mysqli_close($conn);
?>