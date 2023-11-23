<?php
require_once("../helpers/db.php");

function insertProduct($name, $amount, $details, $price, $imagePath)
{
    global $pdo;

    $sql = "INSERT INTO product (p_name, p_amount, p_details, p_price, p_image_path) 
            VALUES (:name, :amount, :details, :price, :imagePath)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':amount', $amount, PDO::PARAM_INT);
    $stmt->bindParam(':details', $details, PDO::PARAM_STR);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':imagePath', $imagePath, PDO::PARAM_STR);

    return $stmt->execute();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if necessary fields are set in the POST data
    if (isset($_POST['productName'], $_POST['productAmount'], $_POST['productDetails'], $_POST['productPrice'])) {
        // Get the data from the POST data
        $productName = $_POST['productName'];
        $productAmount = $_POST['productAmount'];
        $productDetails = $_POST['productDetails'];
        $productPrice = $_POST['productPrice'];

        // Check if a file was uploaded
        if (!empty($_FILES['productImage']['name'])) {
            $targetDir = "uploads/"; // Specify your upload directory
            $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the image file is a actual image or fake image
            $check = getimagesize($_FILES["productImage"]["tmp_name"]);
            if ($check !== false) {
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
                    // Call the insertProduct function to insert a new product with the image path
                    $success = insertProduct($productName, $productAmount, $productDetails, $productPrice, $targetFile);

                    if ($success) {
                        header("Location: product_list.php");
                        echo "Product inserted successfully with image.";
                        // Redirect or handle success accordingly
                    } else {
                        echo "Failed to insert product.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        } else {
            // No image uploaded, insert product without an image path
            $success = insertProduct($productName, $productAmount, $productDetails, $productPrice, null);

            if ($success) {
                echo "Product inserted successfully.";
                header("Location: product_list.php");

                // Redirect or handle success accordingly
            } else {
                echo "Failed to insert product.";
            }
        }
    }
}
