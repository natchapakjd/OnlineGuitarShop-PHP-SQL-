<?php
// Include the database connection
require("../helpers/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $targetDir = "uploads/"; // Specify your upload directory
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // Perform additional checks if needed

        // Move the uploaded file to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Insert the image path into the database
            $imagePath = $targetFile;
            $sql = "INSERT INTO product (p_image_path) VALUES (:imagePath)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);
            $stmt->execute();

            echo "The image has been uploaded and the record has been added to the database.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
?>
