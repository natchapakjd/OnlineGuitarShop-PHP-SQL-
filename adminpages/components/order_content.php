<?php
// Include the database connection
require("../helpers/db.php");
function getOrderItems($orderId)
{
    global $pdo;

    $sql = "SELECT product.p_name, order_items.quantity FROM order_items
            JOIN product ON order_items.p_id = product.p_id
            WHERE ord_id = :orderId";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':orderId', $orderId, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function deleteOrder($id)
{
    global $pdo;

    $sqlOrderItems = "DELETE FROM order_items WHERE ord_id = :id";
    $stmtOrderItems = $pdo->prepare($sqlOrderItems);
    $stmtOrderItems->bindParam(':id', $id, PDO::PARAM_INT);
    $stmtOrderItems->execute();

    $sqlOrder = "DELETE FROM orders WHERE ord_id = :id";
    $stmtOrder = $pdo->prepare($sqlOrder);
    $stmtOrder->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmtOrder->execute();
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'id' is set in the POST data
    if (isset($_POST['id'])) {
        // Get the ID from the POST data
        $id = $_POST['id'];

        // Call the deleteOrder function to delete the order
        $success = deleteOrder($id);

        // Redirect back to the page with DataTables
        // (You might want to specify the correct path or URL)
    }
}

$sql = "SELECT * FROM orders";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/adminpages/index.php">Home</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                            <h3 class="card-title">Orders Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Status</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($orders as $order) : ?>
                                        <tr>
                                            <td><?php echo $order['ord_id']; ?></td>
                                            <td><?php echo $order['ord_date']; ?></td>
                                            <td><?php echo $order['ord_time']; ?></td>
                                            <td><?php echo $order['ord_status']; ?></td>
                                            <td><?php echo $order['total_price']; ?></td>
                                            <td>
                                                <form method="post" action="">
                                                    <input type="hidden" name="id" value="<?php echo $order['ord_id']; ?>">
                                                    <a href="edit_order.php?id=<?php echo $order['ord_id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                    <!-- เพิ่มปุ่ม "Details" และให้กำหนด id ให้กับปุ่ม -->
                                                    <a href="orders_details.php?id=<?php echo $order['ord_id']; ?>" class="btn btn-info btn-sm">Details</a>
                                                </form>
                                            </td>

                                        </tr>
                                        <!-- เพิ่มแถวสำหรับแสดงรายละเอียด -->

                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Total Amount</th>
                                        <th>Actions</th>
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