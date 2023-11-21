<?php
session_start();

include("./components/navbar.php");
require("./helpers/db.php");
require("./calculateTotalPrice.php");

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Retrieve user_id from the session
$user_id = $_SESSION['user_id'];

// Fetch user information from the database (you may need to modify this query)
$sql = "SELECT * FROM users WHERE id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the "Place Order" button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["place_order"])) {
    // Insert order information into the orders table
    $insertOrderSQL = "INSERT INTO orders (ord_status, ord_date, ord_time, id, total_price) 
                       VALUES (:ord_status, CURRENT_DATE(), CURRENT_TIME(), :user_id, :total_price)";
    $stmtOrder = $pdo->prepare($insertOrderSQL);
    $ordStatus = "pending";  // You can set the initial status as needed
    $stmtOrder->bindParam(":ord_status", $ordStatus, PDO::PARAM_STR);
    $stmtOrder->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $totalPrice = calculateTotalPrice($_SESSION['cart']);
    $stmtOrder->bindParam(":total_price", $totalPrice, PDO::PARAM_INT);
    $stmtOrder->execute();

    // Get the last inserted order ID
    $lastOrderId = $pdo->lastInsertId();
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $insertDetailSQL = "INSERT INTO order_items (ord_id, p_id, quantity) 
                            VALUES (:ord_id, :product_id, :quantity)";
        $stmtDetail = $pdo->prepare($insertDetailSQL);
        $stmtDetail->bindParam(":ord_id", $lastOrderId, PDO::PARAM_INT);
        $stmtDetail->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmtDetail->bindParam(":quantity", $quantity, PDO::PARAM_INT);
        $stmtDetail->execute();
    }
    // Insert order details into the order_details table
    foreach ($_SESSION['cart'] as $product_id => $quantity) {

        // Fetch product data based on the product_id
        $sqlProduct = "SELECT * FROM product WHERE p_id = :product_id";
        $stmtProduct = $pdo->prepare($sqlProduct);
        $stmtProduct->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmtProduct->execute();
        $product = $stmtProduct->fetch(PDO::FETCH_ASSOC);

        // Calculate the new quantity after the order
        $newQuantity = $product['p_amount'] - $quantity;

        // Update product quantity in the database
        $updateProductSQL = "UPDATE product SET p_amount = :new_quantity WHERE p_id = :product_id";
        $stmtUpdateProduct = $pdo->prepare($updateProductSQL);
        $stmtUpdateProduct->bindParam(":new_quantity", $newQuantity, PDO::PARAM_INT);
        $stmtUpdateProduct->bindParam(":product_id", $product_id, PDO::PARAM_INT);
        $stmtUpdateProduct->execute();
    }


    // Clear the cart after placing the order
    $_SESSION['cart'] = [];

    // Redirect to a confirmation or thank you page
    header("Location: user_history.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Checkout - Guitar Ordering</title>
    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">Checkout</h1>

        <!-- User Information -->
        <div class="card mb-4">
            <div class="card-header">
                User Information
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> <?php echo $user['name']; ?></p>
                <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
                <p><strong>Telephone:</strong> <?php echo $user['mobile']; ?></p>
                <p><strong>Address:</strong> <?php echo $user['address']; ?></p>

                <!-- Add more user information as needed -->
            </div>
        </div>

        <!-- Order Summary -->
        <div class="card mb-4">
            <div class="card-header">
                Order Summary
            </div>
            <div class="card-body">
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
                                <!-- Add the column to display total price for the product -->
                            </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td class="text-dark font-weight-bold">$<?php echo calculateTotalPrice($_SESSION['cart']); ?></td>
                            <!-- Add the total price cell -->
                        </tr>
                    </tbody>

                </table>
            </div>
        </div>

        <!-- Payment Information -->
        <div class="card mb-4">
            <div class="card-header">
                Payment Information
            </div>
            <div class="card-body">
                <!-- Add payment form content here -->
                <!-- Example: Credit card details, payment method, etc. -->
            </div>
        </div>

        <!-- Order Button -->
        <div class="text-end">
            <form method="post">
                <button type="submit" class="btn btn-primary" name="place_order">Place Order</button>
            </form>

        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
</body>

</html>