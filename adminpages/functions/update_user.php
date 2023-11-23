<?php
// Include the database connection
require("../..//helpers/db.php");

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user data from the POST data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    // Update user data in the database
    $stmt = $pdo->prepare("UPDATE users SET name = :name, role = :role, address = :address, mobile = :mobile WHERE id = :id");
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Redirect back to the page with DataTables
    header("Location: /adminpages/users_manage.php");
    exit();
} else {
    // If the request method is not POST, redirect to the page with DataTables
    header("Location: users_manage.php");
    exit();
}
