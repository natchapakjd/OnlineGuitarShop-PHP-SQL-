<?php
// Include the database connection
require("../helpers/db.php");

// Check if the request meth<?php
include("./components/header.php");
include("./components/navbar.php");
include("./components/sidebar-menu.php");


if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if 'id' is set in the GET data
    if (isset($_GET['id'])) {
        // Get the ID from the GET data
        $id = $_GET['id'];

        // Fetch order details based on the ID
        $order = getOrderDetails($id);

        // Check if the order is found
        if ($order) {
            // Display the order details in the form
            displayOrderForm($order);
        } else {
            // Redirect to the orders page if order is not found
            exit();
        }
    } else {
        // Redirect to the orders page if 'id' is not set
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if form is submitted with updated data
    if (isset($_POST['submit'])) {
        // Get the data from the form
        $orderId = $_POST['order_id'];
        $newStatus = $_POST['new_status'];

        // Update the order status
        $success = updateOrderStatus($orderId, $newStatus);

        if ($success) {
            echo '<script>window.location.href = "order_list.php";</script>';
            // Redirect back to the orders page after successful update
            exit();
        } else {
            // Display an error message or handle the error as needed
            echo "Error updating order status.";
        }
    }
}

function getOrderDetails($orderId)
{
    global $pdo;

    $sql = "SELECT * FROM orders WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function updateOrderStatus($orderId, $newStatus)
{
    global $pdo;

    $sql = "UPDATE orders SET ord_status = :newStatus WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);

    return $stmt->execute();
}

function displayOrderForm($order)
{
?>
    <!-- HTML and Form to display order details and allow editing -->
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Order</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/adminpages/index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="orders.php">Orders</a></li>
                            <li class="breadcrumb-item active">Edit Order</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <div class="card-body">
                                <!-- Display order details here -->
                                <form method="post" action="">
                                    <input type="hidden" name="order_id" value="<?php echo $order['ord_id']; ?>">
                                    <label for="new_status">New Status:</label>
                                    <input type="text" name="new_status" value="<?php echo $order['ord_status']; ?>">
                                    <button type="submit" name="submit" class="btn btn-primary float-end">Update Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

<?php
}
?>
<?php include("./components/footer.php");
