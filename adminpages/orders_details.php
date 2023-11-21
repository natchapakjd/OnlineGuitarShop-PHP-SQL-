<?php
// Include the database connection
require("../helpers/db.php");
include("./components/header.php");
include("./components/navbar.php");
include("./components/sidebar-menu.php");
function getOrderItems($orderId)
{
    global $pdo;

    $sql = "SELECT order_items.ord_id , product.p_name, order_items.quantity FROM order_items
            JOIN product ON order_items.p_id = product.p_id
            WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $orderId = $_GET['id'];

    // Call the getOrderItems function to get order items details
    $orderItems = getOrderItems($orderId);
} else {
    // Redirect back to the orders page if the order ID is not provided
    header('Location: orders.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <!-- Add your CSS stylesheets and other head elements here -->
</head>

<body>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>DataTables</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">DataTables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Order Details</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped text-center">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($orderItems as $item) : ?>
                                            <tr>
                                                <td><?php echo $item['ord_id']; ?></td>
                                                <td><?php echo $item['p_name']; ?></td>
                                                <td><?php echo $item['quantity']; ?></td>
                                            </tr>
                                        <?php endforeach; ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                        <th>ID</th>

                                            <th>Product Name</th>
                                            <th>Quantity</th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Add your HTML content and styles here -->
    <?php include("./components/footer.php"); ?>
    <!-- Add your JavaScript scripts here -->

</body>

</html>