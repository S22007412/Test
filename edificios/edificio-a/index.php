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
$page_tag = 'edificio-a';

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
    <title>UBIUV Edificio A</title>
    <link rel="icon" type="image/x-icon" href="/assets/favicon.ico">
    <!-- Add Poppins font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Define font-family for elements that should use Poppins */
        body, h1, button, input, textarea{
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="navbar-fixed-top">
        <div class="back-arrow">
            <a href="/map/">
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
            <button class="button-page">Edificio A</button>
        </div>
        
        <div class="slider">
            <div class="slides">
                <div class="slide" id="slide-1">
                    <div class="slider-container">
                        <div class="slide-header">
                            <button class="nav prev">‹</button>
                            <span class="nav-text">Historia</span>
                            <button class="nav next">›</button>
                        </div>
                        <div class="pagination">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>

                    <div class="slide-content">
                            <!-- Building Image -->
                        <div class="test">
                            <div class="edificio">
                                <!-- Use the relative path for the img src attribute -->
                                <img class="edificio-img" src="<?php echo htmlspecialchars($relative_target_file); ?>" alt="Edificio A"> 
                                <!--<img class="edificio-img" src="../../assets/edificios/edificio-a.png" alt="Edificio A"> -->
                            </div>

                            <?php if (isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') { ?>
                            
                            <!-- Show the modify button -->
                            <div class="modify-container">
                                <button class="modify-button button-modify" id="modifyButton">Modificar</button>
                                
                                <!-- File upload form (hidden by default) -->
                                <div class="modify-form" style="display: none;">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="modify-input" type="file" name="new_image" id="new_image">
                                        <br><button class="accept-button button-modify" type="submit">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        
                            <?php } ?>
                            </div>
                        </div>

                        <div class="info">
                            <div class="info-container">

                                <div class="info-title">Historia</div>
                                                           
                                <div class="info-content">
                                    <!-- Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec mollis nec dui id tempus. Mauris ornare ipsum faucibus pulvinar maximus. Sed ligula mi, dignissim non sem a, volutpat pharetra nibh. Nunc lacus sapien, sagittis in magna id, faucibus fermentum lectus. Fusce ac est euismod, posuere lorem vitae, consequat massa. -->
                                    <?php 
                                        $id_edificio = '1';
                                        include '/var/www/html/php/edificio-info.php'; 
                                    ?>
                                </div>

                            </div>
                        
                            <?php if(isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') { ?>
                                <div class="modify-container">
                                    <button class="modify-button button-modify" onclick="toggleEditForm()">Modificar</button>
                                    <form id="editForm" action="/php/edit-edificio-info.php" method="POST" class="hidden">
                                        <textarea id="informacion" class="modify-textarea" name="informacion" style="overflow:hidden; resize:none;"><?php echo $informacion; ?></textarea>
                                        <input type="hidden" name="id_edificio" value="<?php echo $id_edificio; ?>">
                                        <button class="accept-button button-modify" type="submit">Guardar</button>
                                    </form>
                                </div>

                                <style>
                                    .hidden { display: none; }
                                    .visible { display: block; }
                                </style>

                                <script>
                                function textAreaAdjust(element) {
                                    var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                                    element.style.height = "auto";
                                    element.style.height = (element.scrollHeight) + "px";
                                    window.scrollTo(0, scrollTop);
                                }

                                function toggleEditForm() {
                                    var form = document.getElementById('editForm');
                                    if (form.classList.contains('hidden')) {
                                        form.classList.remove('hidden');
                                        form.classList.add('visible');
                                        textAreaAdjust(document.getElementById('informacion')); // Adjust textarea height when form is shown
                                    } else {
                                        form.classList.remove('visible');
                                        form.classList.add('hidden');
                                    }
                                }

                                document.addEventListener('DOMContentLoaded', function() {
                                    var textarea = document.getElementById('informacion');
                                    textarea.addEventListener('input', function() {
                                        textAreaAdjust(this);
                                    });
                                });
                                </script>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="slide" id="slide-2">
                    <div class="slider-container">
                        <div class="slide-header">
                            <button class="nav prev">‹</button>
                            <span class="nav-text">Salones</span>
                            <button class="nav next">›</button>
                        </div>
                        <div class="pagination">
                            <span class="dot"></span>
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                    <div class="slide-content">
                        <button class="button-classroom" onclick="toggleBox('clasroom1')">A-14</button>
                        <div class="info-classroom" id="clasroom1" style="display: none;">
                            <img class="classroom-info-img" src="/assets/salones/a-14.png">
                            <?php 
                                $id_salon = '1';
                                $id_edificio = '1';
                                include '/var/www/html/php/salon-info.php'; 
                            ?>
                        </div>
                        <button class="button-classroom" onclick="toggleBox('classroom2')">A-15</button>
                        <div class="info-classroom" id="classroom2" style="display: none;">
                            <img class="classroom-info-img" src="/assets/salones/a-15.png">
                            <?php 
                                $id_salon = '2';
                                $id_edificio = '1';
                                include '/var/www/html/php/salon-info.php'; 
                            ?>
                        </div>
                        <button class="button-classroom" onclick="toggleBox('classroom3')">A-16</button>
                        <div class="info-classroom" id="classroom3" style="display: none;">
                        <img class="classroom-info-img" src="/assets/salones/a-16.png">
                        <?php 
                                $id_salon = '3';
                                $id_edificio = '1';
                                include '/var/www/html/php/salon-info.php'; 
                            ?>
                        </div>
                        <button class="button-classroom" onclick="toggleBox('classroom4')">Aula Magna</button>
                        <div class="info-classroom" id="classroom4" style="display: none;">
                        <img class="classroom-info-img" src="/assets/salones/aula-magna.png">
                        <?php 
                                $id_salon = '5';
                                $id_edificio = '1';
                                include '/var/www/html/php/salon-info.php'; 
                            ?>
                        </div>
                        <button class="button-classroom" onclick="toggleBox('classroom5')">Salón de Actos</button>
                        <div class="info-classroom info-classroom-last" id="classroom5" style="display: none;">
                        <img class="classroom-info-img" src="/assets/salones/salon-actos.png">
                        <?php 
                                $id_salon = '6';
                                $id_edificio = '1';
                                include '/var/www/html/php/salon-info.php'; 
                            ?>
                        </div>
                    </div>
                    <div class="classroom-end-spacing"></div>
                    
                    <script>
                        function toggleBox(id) {
                            var textElement = document.getElementById(id);
                            if (textElement.style.display === "none") {
                                textElement.style.display = "block";
                            } else {
                                textElement.style.display = "none";
                            }
                        }
                    </script>
                    
                    
                </div>

                <div class="slide" id="slide-3">
                    <div class="slider-container">
                        <div class="slide-header">
                            <button class="nav prev">‹</button>
                            <span class="nav-text">Horarios</span>
                            <button class="nav next">›</button>
                        </div>
                        <div class="pagination">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot active"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                    <div class="slide-content">
                        <div class="test">
                            <div class="edificio">
                                <!-- Use the relative path for the img src attribute -->
                                <img class="edificio-img" src="<?php echo htmlspecialchars($relative_target_file); ?>" alt="Edificio A"> 
                                <!--<img class="edificio-img" src="../../assets/edificios/edificio-a.png" alt="Edificio A"> -->
                            </div>

                            <?php if (isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') { ?>
                            
                            <!-- Show the modify button -->
                            <div class="modify-container">
                                <button class="modify-button button-modify" id="modifyButton2">Modificar</button>
                                
                                <!-- File upload form (hidden by default) -->
                                <div class="modify-form2" style="display: none;">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <input class="modify-input" type="file" name="new_image" id="new_image">
                                        <br><button class="accept-button button-modify" type="submit">Aceptar</button>
                                    </form>
                                </div>
                            </div>
                        
                            <?php } ?>
                        </div>

                        <!-- Horarios-->

                        <?php
                            // Determine the absolute path to the schedules.json file
                            $schedulesDownloadJsonFilePath = '/var/www/html/config/schedules_download.json';
                                                        
                            // Read the JSON file
                            $schedulesDownloadJsonString = @file_get_contents($schedulesDownloadJsonFilePath);
                                                        
                            if ($schedulesDownloadJsonString === false) {
                                die('Error: Unable to read the JSON file at ' . $jsonFilePath);
                            }
                            
                            $schedulesDownload = json_decode($schedulesDownloadJsonString, true);
                            
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                die('Error: Invalid JSON data.');
                            }
                        ?>

                        <?php
                            // Determine the absolute path to the schedules.json file
                            $schedulesViewJsonFilePath = '/var/www/html/config/schedules_view.json';
                                                        
                            // Read the JSON file
                            $schedulesViewJsonString = @file_get_contents($schedulesViewJsonFilePath);
                                                        
                            if ($schedulesViewJsonString === false) {
                                die('Error: Unable to read the JSON file at ' . $jsonFilePath);
                            }
                            
                            $schedulesView = json_decode($schedulesViewJsonString, true);
                            
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                die('Error: Invalid JSON data.');
                            }
                        ?>

                        

                        <button class="button-schedule" onclick="toggleBox('schedule2')">A-15</button>
                        <div class="info-schedule" id="schedule2" style="display: none;">
                            <div class="info-schedule-text">Matutino:</div>
                            <a href="<?php echo htmlspecialchars($schedulesView['a-15-matutino']); ?>">
                <button class="button-schedule-download">Ver</button>
            </a>
            <div class="schedule-spacing"></div>   
                <button class="button-schedule-download" id="download-button-1">Descargar</button>
                            
                        </div>

                        <button class="button-schedule" onclick="toggleBox('schedule3')">A-16</button>
                        <div class="info-schedule" id="schedule3" style="display: none;">   
                            <div class="info-schedule-text">Matutino:</div>
                            <a href="<?php echo htmlspecialchars($schedulesView['a-16-matutino']); ?>">
                <button class="button-schedule-download">Ver</button>
            </a>
            <div class="schedule-spacing"></div>
                            
                <button class="button-schedule-download" id="download-button-2">Descargar</button>

            
                        </div>

                        <script>
                            document.getElementById('download-button-1').addEventListener('click', function() {

                                if (navigator.userAgent.indexOf('median') > -1) {
                                    median.share.downloadFile({url: 'https://drive.google.com/uc?export=download&<?php echo htmlspecialchars($schedulesDownload['a-15-matutino']); ?>', open: false})}
                                else {
                                    window.location.href = 'https://drive.google.com/uc?export=download&<?php echo htmlspecialchars($schedulesDownload['a-15-matutino']); ?>';
                                }
                            });

                            document.getElementById('download-button-2').addEventListener('click', function() {

                                if (navigator.userAgent.indexOf('median') > -1) {
                                    median.share.downloadFile({url: 'https://drive.google.com/uc?export=download&<?php echo htmlspecialchars($schedulesDownload['a-16-matutino']); ?>', open: false})}
                                else {
                                    window.location.href = 'https://drive.google.com/uc?export=download&<?php echo htmlspecialchars($schedulesDownload['a-16-matutino']); ?>';
                                }
                            });
                        </script>

                        <div class="schedule-end-spacing"></div>
                        
                    </div>
                    
                </div>

                <div class="slide" id="slide-4">
                    <div class="slider-container">
                        <div class="slide-header">
                            <button class="nav prev">‹</button>
                            <span class="nav-text">¿Cómo llegar?</span>
                            <button class="nav next">›</button>
                        </div>
                        <div class="pagination">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot active"></span>
                        </div>
                    </div>
                    <div class="slide-content">

                        <!-- Recorrido video -->
                        
                        
                        <?php
                            // Determine the absolute path to the schedules.json file
                            $routeLinksJsonFilePath = '/var/www/html/config/route_links.json';
                                                        
                            // Read the JSON file
                            $routeLinksJsonString = @file_get_contents($routeLinksJsonFilePath);
                                                        
                            if ($routeLinksJsonString === false) {
                                die('Error: Unable to read the JSON file at ' . $jsonFilePath);
                            }
                            
                            $routeLinks = json_decode($routeLinksJsonString, true);
                            
                            if (json_last_error() !== JSON_ERROR_NONE) {
                                die('Error: Invalid JSON data.');
                            }
                        ?>

                        <!---
                        <iframe class="route-video" width="100%" height="100%" src="https://www.youtube.com/embed/tgbNymZ7vqY">
                        </iframe>-->
                        
                        <button class="button-route" onclick="toggleBox('route1')">A-14</button>
                        <div class="info-route" id="route1" style="display: none;">
                            <iframe class="route-video" width="100%" height="100%" 
                                src="<?php echo htmlspecialchars($routeLinks['salon-a-14']); ?>">
                            </iframe> 
                        </div>
                        <button class="button-route" onclick="toggleBox('route2')">A-15</button>
                        <div class="info-route" id="route2" style="display: none;">
                            <iframe class="route-video" width="100%" height="100%" 
                                src="<?php echo htmlspecialchars($routeLinks['salon-a-15']); ?>">
                            </iframe> 
                        </div>
                        <button class="button-route" onclick="toggleBox('route3')">A-16</button>
                        <div class="info-route" id="route3" style="display: none;">
                            <iframe class="route-video" width="100%" height="100%" 
                                src="<?php echo htmlspecialchars($routeLinks['salon-a-16']); ?>">
                            </iframe> 
                        </div>
                        <button class="button-route" onclick="toggleBox('route4')">Aula Magna</button>
                        <div class="info-route" id="route4" style="display: none;">
                            <iframe class="route-video" width="100%" height="100%" 
                                src="<?php echo htmlspecialchars($routeLinks['salon-aula-magna']); ?>">
                            </iframe> 
                        </div>
                        <button class="button-route" onclick="toggleBox('route5')">Salón de Actos</button>
                        <div class="info-route" id="route5" style="display: none;">
                            <iframe class="route-video" width="100%" height="100%" 
                                src="<?php echo htmlspecialchars($routeLinks['salon-actos']); ?>">
                            </iframe> 
                        </div>
                    
                    <div class="classroom-end-spacing"></div>

                    </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="/scripts/upload-form-visibility.js"></script>

        <script src="/scripts/slider.js"></script>
        </div>
    </div>

    <div class="navbar-fixed-bottom">
        <div class="footer-separator"></div>
        <div class="icon-container">
            <a href="/home/">
                <img class="icon" class="home-icon" src="/assets/icon-home.png">
            </a>
            <a href="/map/">
                <img class="icon" src="/assets/icon-main.png">
            </a>
            <a>
                <img class="icon cursable" id="menu-button" src="/assets/icon-menu.png">
            </a>
        </div>
    </div>

    <style>
        .hidden {
            display: none;
        }
    </style>

<div class="menu hidden" id="menu">
        <div class="menu-options">
            <a class="menu-option highlight">BARRA DE OPCIONES</a>
            <a href="https://www.uv.mx/" class="menu-option">PÁGINA DE LA UV</a>
            <a href="https://dsia.uv.mx/miuv/escritorio/login.aspx" class="menu-option">PÁGINA DE MIUV</a>
            <a href="https://www.uv.mx/pozarica/fiec/general/instalaciones/" class="menu-option">INSTALACIONES</a>
            <a href="/about/" class="menu-option">ACERCA DE</a>
            <a href="/creators/" class="menu-option">CREADORES</a>
            <a href="/thanks/" class="menu-option">AGRADECIMIENTOS</a>
            <a href="/news/" class="menu-option">NOVEDADES</a>
            <a href="/login/" class="menu-option">CERRAR SESIÓN</a>
        </div>
        <div class="menu-content">
            <div class="menu-logo-container">
                <img src="/assets/logo-uv.png" alt="UBIUV">
                <h1>UBIUV</h1>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
        var menu = document.getElementById('menu');
        menu.classList.toggle('hidden');
    });
    </script>
</body>