<?php
include '../../php/connection.php';

$email = $_POST['username'];
$pass = $_POST['password'];

$tsql = "SELECT * FROM admin WHERE email='$email' AND pass='$pass'";

$stmt = sqlsrv_query($conn, $tsql);

if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
}

if (sqlsrv_has_rows($stmt)) {
    echo "<script>";
    echo "window.location = '../admin-main/index.html';";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('Usuario incorrecto');";
    echo "window.location = 'index.php';";
    echo "</script>";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
