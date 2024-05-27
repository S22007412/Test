<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="user-scalable=no">
    <title>Edificio <A></A></title>
    <!-- Add Poppins font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Define font-family for elements that should use Poppins */
        body, h1, button {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="navbar-fixed-top">
        <div class="back-arrow">
            <a href="">
                <img class="arrow-img" src="../../../assets/icon-arrow-left.png">
            </a>
        </div>        
        <div class="logo-container">
            <div class="part1">
                <img class="logouv" src="../../../assets/logo-uv.png" alt="Logo UV">
            </div>
            <div class="part2">
                <h1>UBIUV</h1>  
            </div>
        </div>
        <div class="header-separator"></div>
    </div>

    <div class="main">

        <!-- Building Tittle -->
        <div class="edificio">
            <button>Edificio B</button>
        </div>
        
        <!-- Building Image -->
        <img class="edificio-img" src="../../../assets/facultad.jpg" alt="FIEC">
        
        <!-- Modify Image Button-->
        <?php if(isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') { ?>
            <style> 
                .edificio-img {
                margin-bottom: 4vh;
                }
            </style>
            <br><button class="modify-button">Modificar</button>
        <?php } ?>
        
        <!-- Content Buttons -->
        <div class="botones">
            <div class="historia">
                <a href="../historia/index.html"><button>
                    Historia
                </button></a>
            </div>
            <div class="salones">
                <a href="../salones/salones/index.html"><button>
                    Salones
                </button></a>
            </div>
            <div class="horarios">
                <a href="../horarios/horarios/index.html"><button>
                    Horarios
                </button></a>
            </div>
    
            <div class="comollegar">
                <a href="../como-llegar/como-llegar/index.html"><button>
                    ¿Cómo llegar?
                </button></a>
            </div>
        </div>
    </div>

    <div class="navbar-fixed-bottom">
        <div class="footer-separator"></div>
        <div class="icon-container">
            <img class="icon" class="home-icon" src="../../../assets/icon-home.png">
            <img class="icon" src="../../../assets/icon-main.png">
            <img class="icon" src="../../../assets/icon-menu.png">
        </div>
    </div>
</body>