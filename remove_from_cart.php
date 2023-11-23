<?php
session_start();

// Check if the product_id is passed through the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["product_id"])) {
    $product_id = $_GET["product_id"];

    // Check if the cart session variable exists
    if (isset($_SESSION['cart'])) {
        // Check if the product is in the cart
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            // If the quantity is greater than 1, decrease the quantity
            if ($_SESSION['cart'][$product_id] > 1) {
                $_SESSION['cart'][$product_id]--;
            } else {
                // If the quantity is 1, remove the product from the cart
                unset($_SESSION['cart'][$product_id]);
            }
        }
    }
}

// Redirect back to the cart page
header("Location: cart.php");
exit();
?>
