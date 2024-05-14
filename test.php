<?php
session_start(); // Start the session

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['session_type'])) {
        $_SESSION['session_type'] = $_POST['session_type']; // Store the session type
        
        
        if($_SESSION['session_type'] == 'admin') {
            header("Location: 1.html");
        }
        if($_SESSION['session_type'] == 'student') {
            header("Location: 2.html");
        }
        if($_SESSION['session_type'] == 'guest') {
            header("Location: 3.html");
        }
        
        
        exit;
    }
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no">
    <title>UBIUV</title>
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
        <div class="logo-container">
            <div class="part1">
                <img class="logouv" src="../../../assets/logo-uv.png" alt="Logo UV">
            </div>
            <div class="part2">
                <h1>UBIUV</h1>
            </div>
        </div>
        <div class="intro">
            <h1>Entrar Como:</h1>
            <br><h1>si jalo el cambio</h1>
        </div>
        <div class="centerbutton">
            <div class="button">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <button class="button button1" type="submit" name="session_type" value="admin">
                        <p>Administrador</p>
                    </button>
                </form>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <button class="button button1" type="submit" name="session_type" value="student">
                        <p>Estudiante</p>
                    </button>
                </form>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <button class="button button1" type="submit" name="session_type" value="guest">
                        <p>Invitado</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
