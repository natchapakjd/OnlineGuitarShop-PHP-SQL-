<?php
include("./components/navbar.php");
require("./helpers/db.php");

// Fetch data from the "products" table
$sql = "SELECT * FROM product WHERE p_amount != 0;";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Layout</title>

    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container mt-5">
        <div class="row">

            <?php
            // Loop through the fetched data and display product cards
            foreach ($products as $product) {
            ?>

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="./images/R.png" class="card-img-top" alt="Product 3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                            <!-- <p class="card-text text-muted">Category: <?php echo $product['p_type_id']; ?></p> -->
                            <p class="card-text text-muted">Amount: <?php echo $product['p_amount']; ?></p>
                            <p class="card-text">Description: <?php echo $product['p_details']; ?></p>
                            <h6 class="card-subtitle mb-2 text-muted">Price: $<?php echo $product['p_price']; ?></h6>
                            <!-- Add to Cart button with a link to a script to handle adding to cart -->
                            <a href="cart.php?product_id=<?php echo $product['p_id']; ?>" class="btn btn-primary">Add to Cart</a>
                        </div>
                    </div>
                </div>

            <?php
            }
            ?>

        </div>
    </div>

    <!-- Bootstrap JS -->
</body>

</html>