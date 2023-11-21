<?php
session_start();
include("./components/navbar.php");
require("./helpers/db.php");
require("./calculateTotalPrice.php");


// Check if the product_id is passed through the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    // Fetch product data based on the product_id
    $sql = "SELECT * FROM product WHERE p_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Check if the cart session variable exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        // Check if the product is already in the cart
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // Check if adding the product will exceed the available quantity
            if ($_SESSION['cart'][$product_id] < $product['p_amount']) {
                // If the product is already in the cart and adding won't exceed available quantity, increase the quantity
                $_SESSION['cart'][$product_id]++;
            } else {
                // If adding the product will exceed available quantity, display an alert
                echo "<script>alert('Quantity exceeds available stock.');</script>";
            }
        } else {
            // If the product is not in the cart, add it with quantity 1
            $_SESSION['cart'][$product_id] = 1;
        }

        // Redirect back to the product page or cart page
        header("Location: cart.php"); // Change the URL to your product page
        exit();
    } else {
        // Product not found
        echo "Product not found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Shopping Cart</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the cart data and display product details
                foreach ($_SESSION['cart'] as $product_id => $quantity) {
                    // Fetch product data based on the product_id
                    $sql = "SELECT * FROM product WHERE p_id = :product_id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $product = $stmt->fetch(PDO::FETCH_ASSOC);

                    // Calculate total price for the product
                    $totalPrice = $quantity * $product['p_price'];
                ?>
                    <tr>
                        <th scope="row"><?php echo $product_id; ?></th>
                        <td><?php echo $product['p_name']; ?></td>
                        <td><?php echo $quantity; ?></td>
                        <td>$<?php echo $product['p_price']; ?></td>
                        <td>$<?php echo $totalPrice; ?></td>
                        <td><a href="remove_from_cart.php?product_id=<?php echo $product_id; ?>" class="btn btn-danger">Remove</a></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

        <div class="text-end">
            <h4>Total: $<?php echo calculateTotalPrice($_SESSION['cart']); ?></h4>
            <a href="checkout.php" class="btn btn-primary">Checkout</a>
            <a href="product.php" class="btn btn-secondary">Continue Shopping</a>
        </div>
    </div>

</body>

</html>
