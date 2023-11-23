<?php
// Include the database connection
require("../helpers/db.php");

// Function to get product data from the database
function getProducts()
{
    global $pdo;

    $sql = "SELECT * FROM product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function deleteProduct($id)
{
    global $pdo;

    // Start a transaction to ensure data consistency
    $pdo->beginTransaction();

    try {
        // Delete from order_items first (assuming p_id is a foreign key in order_items)
        $sqlOrderItems = "DELETE FROM order_items WHERE p_id = :id";
        $stmtOrderItems = $pdo->prepare($sqlOrderItems);
        $stmtOrderItems->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtOrderItems->execute();

        // Then, delete from the product table
        $sqlProduct = "DELETE FROM product WHERE p_id = :id";
        $stmtProduct = $pdo->prepare($sqlProduct);
        $stmtProduct->bindParam(':id', $id, PDO::PARAM_INT);
        $stmtProduct->execute();

        // Commit the transaction
        $pdo->commit();

        return true; // Return true if the transaction was successful
    } catch (Exception $e) {
        // Rollback the transaction if an exception occurred
        $pdo->rollback();
        return false; // Return false if there was an error
    }
}

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if 'id' is set in the POST data
    if (isset($_POST['id'])) {
        // Get the ID from the POST data
        $id = $_POST['id'];

        // Call the deleteUser function to delete the user
        $success = deleteProduct($id);

        // Redirect back to the page with DataTables

    }
}



// Retrieve product data
$products = getProducts();
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                            <h3 class="card-title">Products data</h3>
                        </div>
                        <div class="card-body">

                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($products as $product) : ?>
                                        <tr>
                                            <td><?php echo $product['p_id']; ?></td>
                                            <td>
                                                <img src="<?php echo $product['p_image_path']; ?>" alt="<?php echo $product['p_name']; ?>" style="max-width: 100px;">
                                            </td>
                                            <td><?php echo $product['p_name']; ?></td>
                                            <td><?php echo $product['p_amount']; ?></td>
                                            <td><?php echo $product['p_details']; ?></td>
                                            <td>$<?php echo $product['p_price']; ?></td>
                                            <!-- Inside the <tbody> section of your DataTable -->
                                            <td>
                                                <form method="post" action="">
                                                    <input type="hidden" name="id" value="<?php echo $product['p_id']; ?>">
                                                    <a href="edit_product.php?id=<?php echo $product['p_id']; ?>" class="btn btn-success btn-sm">Edit</a>

                                                    <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                                                </form>
                                            </td>

                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Amount</th>
                                        <th>Details</th>
                                        <th>Price</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                            </table>
                            <hr>
                            <h2>INSERT Product</h2>
                            <form action="insert_product.php" method="post" enctype="multipart/form-data">
                                <label class="form-label" for="productName">Product Name:</label>
                                <input class="form-control" type="text" name="productName" required>
                                <br>

                                <label for="productAmount">Product Amount:</label>
                                <input class="form-control" type="number" name="productAmount" required>
                                <br>

                                <label for="productDetails">Product Details:</label>
                                <textarea class="form-control" name="productDetails" required></textarea>
                                <br>

                                <label for="productPrice">Product Price:</label>
                                <input class="form-control" type="text" name="productPrice" required>
                                <br>

                                <input class=" mb-3" type="file" name="productImage" accept="image/*">
                                <br>

                                <input class="btn btn-primary btn-sm delete-btn mb-3" type="submit" value="Submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>