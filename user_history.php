<?php
// Include the navbar and establish a session
include("./components/navbar.php");
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}

// Include the database connection
require("./helpers/db.php");

// Retrieve user_id from the session
$user_id = $_SESSION['user_id'];

// Query to retrieve user's order history with details
$sql = "SELECT o.ord_id, o.ord_date, o.ord_time, o.ord_status, 
               p.p_name, p.p_price, oi.quantity
        FROM orders o
        JOIN order_items oi ON o.ord_id = oi.ord_id
        JOIN product p ON oi.p_id = p.p_id
        WHERE o.id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
$stmt->execute();
$userOrders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>User History - Guitar Ordering</title>
    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container mt-5">
        <h1 class="mb-4">User History - Guitar Ordering</h1>

        <!-- Table to display user history -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Order Date</th>
                    <th scope="col">Order Time</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through user orders and display them
                foreach ($userOrders as $order) {
                ?>
                    <tr>
                        <td><?php echo $order['ord_id']; ?></td>
                        <td><?php echo $order['ord_date']; ?></td>
                        <td><?php echo $order['ord_time']; ?></td>
                        <td><?php echo $order['p_name']; ?></td>
                        <td><?php echo $order['p_price']; ?></td>
                        <td><?php echo $order['quantity']; ?></td>
                        <td><?php echo $order['p_price'] * $order['quantity']; ?></td>
                        <td>
                            <?php
                            // Display status badge based on the order status
                            $statusClass = getStatusClass($order['ord_status']);
                            echo "<span class=\"badge $statusClass\">" . ucfirst($order['ord_status']) . "</span>";
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS (optional) -->
</body>

</html>

<?php
// Function to get the Bootstrap badge class based on order status
function getStatusClass($status)
{
    switch ($status) {
        case 'completed':
            return 'bg-success';
        case 'pending':
            return 'bg-warning';
        case 'canceled':
            return 'bg-danger';
        case 'in_progress':
            return 'bg-info';
        default:
            return 'bg-secondary';
    }
}
?>
