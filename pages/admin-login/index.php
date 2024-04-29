<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>---sesión Administrador</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>

    <div class="main">
        <div class="logo-container">
            <div class="logoubiuv">
                <div class="logo-wrapper">
                <img class="logouv" src="../../assets/logo-uv.png" alt="Logo UV">
            </div>
            <h1>UBIUV</h1>
            <form action="login.php" method="POST">
                <div class="input-container">
                    <span class="input-icon user-icon"></span>
                    <input type="text" id="username" name="username" placeholder="          Correo institucional">
                </div>
                <div class="input-container">
                    <span class="input-iconn password-icon"></span>
                    <input type="password" id="password" name="password" placeholder="          Contraseña">
                </div>
                <button id="loginButton" class="boton">Iniciar Sesión</button>
            </form>
            <?php
                echo 'php is working';
            ?>
        </div>
    </div>
</body>
</html>
