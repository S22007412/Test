<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // Start the session

// Define the relative path to the target directory
$relative_target_dir = "/assets/";
$absolute_target_dir = "/var/www/html/assets/";

// Define the path to the JSON file that stores the image paths
$json_file_path = '/var/www/html/image_paths.json';

// The tag for this specific page
$page_tag = 'fiec';

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
    <title>Edificio</title>
    <!-- Add Poppins font -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Define font-family for elements that should use Poppins */
        body, h1, button {
            font-family: 'Poppins', sans-serif;
        }

        /* Hide the file input and submit button by default */
        .modificar-form {
            display: none;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="linea"></div>
        <div class="edificio">
            <div class="texto">
                <div class="miu"><h2>Salón A-15</h2></div>
            </div>
        </div>
        
        <div class="fiec">
            <!-- Use the relative path for the img src attribute -->
            <img class="fiec-img" src="<?php echo htmlspecialchars($relative_target_file); ?>" alt="FIEC">
        </div>
        
        <?php
        if (isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') {
        ?>
            <!-- Show the modify button -->
            <div class="modificar">
                <button id="modifyButton">Modificar</button>
            </div>

            <!-- File upload form (hidden by default) -->
            <div class="modificar-form">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="new_image" id="new_image">
                    <button type="submit">Modificar</button>
                </form>
            </div>
        <?php
        }
        ?>
        <div class="linea"></div>
    </div>

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
</body>
</html>
