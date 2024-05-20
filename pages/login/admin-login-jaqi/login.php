<?php
include '../../../php/connection.php';

$email = $_POST['username'];
$pass = $_POST['password'];

$tsql = "SELECT * FROM administrador WHERE email='$email' AND pass='$pass'";
$tsql2 = "SELECT * FROM usuario WHERE email='$email' AND pass='$pass'";

$stmt = sqlsrv_query($conn, $tsql);
$stmt2 = sqlsrv_query($conn, $tsql2);

if ($stmt === false and $stmt2 === false) {
    die(formatErrors(sqlsrv_errors()));
}


if (sqlsrv_has_rows($stmt)) {
    echo "<script>";
    echo "window.location = '../../admin/main/intro/index.html';";
    echo "</script>";
}
else if (sqlsrv_has_rows($stmt2)) {
    echo "<script>";
    echo "window.location = '../../admin/main/intro/index.html';";
    echo "</script>";
}
else {
    echo "<script>";
    echo "alert('Usuario incorrecto');";
    echo "window.location = 'index.php';";
    echo "</script>";
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>




    die(formatErrors(sqlsrv_errors()));
}

if (sqlsrv_has_rows($stmt2)) {
    echo "<script>";
    echo "window.location = '../../usuario/main/intro/index.html';";
    echo "</script>";
}
