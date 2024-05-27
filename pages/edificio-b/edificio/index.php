<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

// Define the relative path to the target directory
$relative_target_dir = "/assets/";
$absolute_target_dir = "/var/www/html/assets/";

// Define the path to the JSON file that stores the image paths
$json_file_path = '/var/www/html/config/image_paths.json';

// The tag for this specific page
$page_tag = 'edificio-b';

// Include the image upload logic
include '/var/www/html/php/image-upload.php';

// If no upload, read the current image path from the JSON file
$image_paths = read_image_paths($json_file_path);
$relative_target_file = isset($image_paths[$page_tag]) ? $image_paths[$page_tag] : $relative_target_dir . "fiec.png";
?>

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
        body, h1, button, input {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="navbar-fixed-top">
        <div class="back-arrow">
            <a href="">
                <img class="arrow-img" src="/assets/icon-arrow-left.png">
            </a>
        </div>        
        <div class="logo-container">
            <div class="part1">
                <img class="logouv" src="/assets/logo-uv.png" alt="Logo UV">
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
        <div class="edificio">
            <!-- Use the relative path for the img src attribute -->
            <img class="edificio-img" src="<?php echo htmlspecialchars($relative_target_file); ?>" alt="Edificio B">
        </div>
        
        <?php
        if (isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') {
        ?>
            <!-- Show the modify button -->
            
            <style> 
                .edificio-img {
                margin-bottom: 4vh;
                }
            </style>
            <br><button class="modify-button" id="modifyButton">Modificar</button>

            <!-- File upload form (hidden by default) -->
            <div class="modificar-form" style="display: none;">
                <form action="" method="post" enctype="multipart/form-data">
                    <input class="modify-input" type="file" name="new_image" id="new_image">
                    <br> 
                    <button class="accept-button" type="submit">Aceptar</button>
                </form>
            </div>
        <?php
        }
        ?>

<script>
        // JavaScript to toggle visibility of file upload form
        document.getElementById('modifyButton').addEventListener('click', function() {
            var form = document.querySelector('.modificar-form');
            if (form.style.display === 'none' || form.style.display === '') {
                form.style.display = 'block';
            } else {
                form.style.display = 'none';
            }
        });
    </script>
        
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