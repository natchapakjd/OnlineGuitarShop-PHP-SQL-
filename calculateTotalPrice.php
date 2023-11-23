<?php
function calculateTotalPrice($cart)
{
    $totalPrice = 0;
    require("./helpers/db.php");

    foreach ($cart as $product_id => $quantity) {
        // Fetch product data based on the product_id
        $sql = "SELECT p_price FROM product WHERE p_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calculate total price for the product
        $totalPrice += $quantity * $product['p_price'];
    }

    return $totalPrice;
}
