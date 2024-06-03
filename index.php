<?php
session_start();
$_SESSION['retry'] = 'false';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no">
    <title>UBIUV</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <!-- Add Poppins font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Define font-family for elements that should use Poppins */
        body, h1, p, button {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="logoubiuv">
            <img class="logouv" src="assets/logo-uv.png" alt="Logo UV">
            <h1>UBIUV</h1>
        </div>
        <div class="intro">
            <h1>Bienvenido a UBIUV</h1>
            <p>Explora, aprende y conecta:<br>Navegando el futuro educativo<br>en nuestro campus universitario.</p>
        </div>
        <div class="centerbutton">
            <div class="button">
                <a href="/login/">
                    <button class="button button1"><p>Comenzar</p></button>
                </a>
            </div>
            <div class="button-spacing"></div>
            <!--
            <div class="button">
                <form action="php/set-session-guest.php" method="post">
                    <button class="button button1"><p>Invitado</p></button>
                </a>
            </div>
            -->
        </div>
    </div>
</body>
</html>
