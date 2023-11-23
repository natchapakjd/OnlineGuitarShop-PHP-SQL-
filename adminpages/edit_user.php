<?php
include("./components/header.php");
include("./components/navbar.php");
include("./components/sidebar-menu.php");
require("../helpers/db.php");

// Check if 'id' is set in the GET data
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user data by ID
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo "User not found";
        exit();
    }

    // นำข้อมูลมาใส่ในตัวแปร
    $username = $user['username'];
    $name = $user['name'];
    $role = $user['role'];
    $address = $user['address'];
    $mobile = $user['mobile'];

    // HTML form for editing user data
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit User</title>
        <!-- Bootstrap CSS or other styling -->
    </head>

    <body>
        <div class="content-wrapper " style="background-color: white;">

            <div class="container mt-5" ">
                <h2>Edit User</h2>
                <form action=" /adminpages/functions/update_user.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <input type="text" class="form-control" id="role" name="role" value="<?php echo $role; ?>">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Mobile:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
        </div>
    </body>

    </html>
<?php
} else {
    // If 'id' is not set in the GET data, redirect to the page with DataTables
    header("Location: adminpages/users_manage.php");
    exit();
}
include("./components/footer.php");

?>