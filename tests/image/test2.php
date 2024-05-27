<?php
session_start(); // Start the session

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['new_image'])) {
    // Directory where the uploaded file will be moved
    $target_dir = "../../assets/";
    $target_file = $target_dir . basename($_FILES["new_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["new_image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["new_image"]["size"] > 500000) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.<br>";
    // if everything is ok, try to upload file
    } else {
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        if (move_uploaded_file($_FILES["new_image"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["new_image"]["name"])) . " has been uploaded.<br>";
            // Update the image source to the new uploaded file
            $image_src = $target_file;
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
            echo "Error details: " . print_r(error_get_last(), true) . "<br>";
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
            <img class="fiec-img" src="<?php echo isset($image_src) ? $image_src : '../../assets/fiec.png'; ?>" alt="FIEC">
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
