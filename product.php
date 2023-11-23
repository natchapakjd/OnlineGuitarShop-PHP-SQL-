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
    <link rel="stylesheet" href="styles/main.css">
    <style>
        body {
            font-family: "Open Sans", sans-serif;
            font-size: 20px;
        }
    </style>
    <!-- Bootstrap CSS -->
</head>

<body>

    <div class="container mt-5">
        <div class="row">

            <?php
            // Loop through the fetched data and display product cards
            foreach ($products as $product) {
            ?>

                <div class="col-md-3 mb-3">
                    <div class="card">
                        <img src="/adminpages/<?php echo $product['p_image_path']; ?>" class="card-img-top img-fluid" alt="Product 3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['p_name']; ?></h5>
                            <p class="card-text">Description: <?php echo $product['p_details']; ?></p>
                            <div class="d-flex justify-content-between">
                                <h6 class="card-subtitle text-muted ">Price: $<?php echo $product['p_price']; ?></h6>
                                <a href="cart.php?product_id=<?php echo $product['p_id']; ?>" class="text-decoration-none">
                                    <h6 class="card-subtitle text-muted text-decoration-none">Add to cart</h6>
                                </a>


                            </div>

                        </div>
                        <div class="card-footer text-muted text-center">
                            <h6 class="card-subtitle text-muted">Amount:<?php echo $product['p_amount']; ?></h6>

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