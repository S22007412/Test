<?php
include '../../../../php/connection.php';

// Assuming you have variables $id_edificio and $id_salon defined somewhere earlier
$id_edificio = '1';
$id_salon = '1';

$tsql = "SELECT informacion FROM salones WHERE id_edificio='$id_edificio' AND id_salon='$id_salon';";

$stmt = sqlsrv_query($conn, $tsql);

if ($stmt === false) {
    die(formatErrors(sqlsrv_errors()));
}

// Fetch the result
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
$informacion = $row['informacion'];

// Echo the result
echo $informacion;

// Free the statement and close the connection
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
