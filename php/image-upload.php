<?php
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
}
?>
