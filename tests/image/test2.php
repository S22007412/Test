<?php
session_start(); // Start the session

$target_file = "/assets/fiec.png";

// Define the absolute path to the target directory
$target_dir = "/var/www/html/assets/";

// Initialize a flag to determine if the upload is successful
$uploadOk = 1;

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['new_image'])) {
    $target_file = $target_dir . basename($_FILES['new_image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Debug: Output the target file path
    echo "Target file path: $target_file<br>";

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES['new_image']['tmp_name']);
    if ($check !== false) {
        echo "File is an image - " . $check['mime'] . ".";
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (5MB max)
    if ($_FILES['new_image']['size'] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowed_formats = ['jpg', 'png', 'jpeg', 'gif', 'webp'];
    if (!in_array($imageFileType, $allowed_formats)) {
        echo "Sorry, only JPG, JPEG, PNG, GIF, and WEBP files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // If everything is ok, try to upload file
        if (move_uploaded_file($_FILES['new_image']['tmp_name'], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES['new_image']['name'])) . " has been uploaded.";

            // Debug: Check if file exists after upload
            if (file_exists($target_file)) {
                echo "File uploaded successfully and found at $target_file.";
            } else {
                echo "File upload appears to have failed, file not found at $target_file.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
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
            <!-- The absolute source should be /var/www/html/assets/fiec.png -->
            <img class="fiec-img" src=<?php echo $target_file ?> alt="FIEC">
        </div>
        
        <?php
        if (isset($_SESSION['session_type']) && $_SESSION['session_type'] == 'admin') {
        ?>
            <div class="modificar">
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
</body>
</html>
