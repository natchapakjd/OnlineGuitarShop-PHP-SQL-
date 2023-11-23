<?php
require_once("../helpers/db.php");

function updateProduct($id, $name, $amount, $details, $price, $imagePath)
{
    global $pdo;

    $sql = "UPDATE product 
            SET p_name = :name, 
                p_amount = :amount, 
                p_details = :details, 
                p_price = :price, 
                p_image_path = :imagePath
            WHERE p_id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
    if (isset($_POST['id'], $_POST['productName'], $_POST['productAmount'], $_POST['productDetails'], $_POST['productPrice'])) {
        // Get the data from the POST data
        $id = $_POST['id'];
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
                    // Call the updateProduct function to update the product with the new image path
                    $success = updateProduct($id, $productName, $productAmount, $productDetails, $productPrice, $targetFile);

                    if ($success) {
                        header("Location: product_list.php");

                        echo "Product updated successfully with new image.";
                        // Redirect or handle success accordingly
                    } else {
                        echo "Failed to update product.";
                    }
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        } else {
            // No new image uploaded, update product without changing the image path
            $success = updateProduct($id, $productName, $productAmount, $productDetails, $productPrice, null);

            if ($success) {
                echo "Product updated successfully.";
                // Redirect or handle success accordingly
            } else {
                echo "Failed to update product.";
            }
        }
    }
}
