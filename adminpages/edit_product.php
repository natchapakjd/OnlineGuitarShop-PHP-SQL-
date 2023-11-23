<?php
include("./components/header.php");
include("./components/navbar.php");
include("./components/sidebar-menu.php");
require("../helpers/db.php");

// Check if 'id' is set in the GET data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch product data by ID
    $stmt = $pdo->prepare("SELECT * FROM product WHERE p_id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found";
        exit();
    }

    // Assign product data to variables
    $productName = $product['p_name'];
    $productImagePath = $product['p_image_path'];
    $productAmount = $product['p_amount'];
    $productDetails = $product['p_details'];
    $productPrice = $product['p_price'];

    // HTML form for editing product data
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product</title>
        <!-- Bootstrap CSS or other styling -->
    </head>

    <body>
        <div class="content-wrapper " style="background-color: white;">

            <div class="container mt-5">
                <h2>Edit Product</h2>
                <form action="/adminpages/update_product.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" value="<?php echo $productName; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="productAmount" class="form-label">Product Amount:</label>
                        <input type="text" class="form-control" id="productAmount" name="productAmount" value="<?php echo $productAmount; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productDetails" class="form-label">Product Details:</label>
                        <input type="text" class="form-control" id="productDetails" name="productDetails" value="<?php echo $productDetails; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Product Price:</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice" value="<?php echo $productPrice; ?>">
                    </div>
                    <div class="mb-3">
                        <input type="file" id="productImage" name="productImage">
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>

            </div>
        </div>
    </body>

    </html>
<?php
} else {
    // If 'id' is not set in the GET data, redirect to the page with DataTables
    header("Location: adminpages/product_list.php");
    exit();
}
include("./components/footer.php");
?>