<?php
session_start(); // Start the session

// Define the relative path to the target directory
$relative_target_dir = "/assets/";
$absolute_target_dir = "/var/www/html/assets/";

// Define the path to the JSON file that stores the image paths
$json_file_path = '/var/www/html/image_paths.json';

// The tag for this specific page
$page_tag = 'fiec';

// Initialize a flag to determine if the upload is successful
$uploadOk = 1;

// Function to read image paths from JSON file
function read_image_paths($json_file_path) {
    if (file_exists($json_file_path)) {
        $json_data = file_get_contents($json_file_path);
        return json_decode($json_data, true);
    }
    return [];
}

// Function to write image paths to JSON file
function write_image_paths($json_file_path, $image_paths) {
    $json_data = json_encode($image_paths, JSON_PRETTY_PRINT);
    file_put_contents($json_file_path, $json_data);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['new_image'])) {
    $target_file = $absolute_target_dir . basename($_FILES['new_image']['name']);
    $relative_target_file = $relative_target_dir . basename($_FILES['new_image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Debug: Output the target file path
    echo "Target file path: $target_file<br>";

    // Check if image file is an actual image or fake image
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

                // Read current image paths
                $image_paths = read_image_paths($json_file_path);

                // Update the path for this page's tag
                $image_paths[$page_tag] = $relative_target_file;

                // Save the updated paths back to the JSON file
                write_image_paths($json_file_path, $image_paths);
            } else {
                echo "File upload appears to have failed, file not found at $target_file.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    // If no upload, read the current image path from the JSON file
    $image_paths = read_image_paths($json_file_path);
    $relative_target_file = isset($image_paths[$page_tag]) ? $image_paths[$page_tag] : $relative_target_dir . "fiec.png";
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
