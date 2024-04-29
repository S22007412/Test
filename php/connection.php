<?php
$serverName = "s22007412-server.database.windows.net";
$connectionOptions = array(
    "database" => "ubiuv",
    "uid" => "d1rdrd",
    "pwd" => "derre.UV1!"
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if ($conn === false) {
    die(formatErrors(sqlsrv_errors()));
}

function formatErrors($errors)
{
    // Display errors
    echo "<h1>SQL Error:</h1>";
    echo "Error information: <br/>";
    foreach ($errors as $error) {
        echo "SQLSTATE: ". $error['SQLSTATE'] . "<br/>";
        echo "Code: ". $error['code'] . "<br/>";
        echo "Message: ". $error['message'] . "<br/>";
    }
}
?>
