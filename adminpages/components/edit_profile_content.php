<?php
require_once '../helpers/db.php';


// ดึง user_id จาก session
if (!isset($_SESSION['user_id'])) {
    // ถ้าไม่มี user_id ใน session ให้ทำการ redirect หรือจัดการตามที่คุณต้องการ
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found";
    exit();
}

// นำข้อมูลมาใส่ในตัวแปร
$username = $user['username'];
$email = $user['email'];
$mobile = $user['mobile'];
$address = $user['address'];
$name = $user['name'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
</head>

<body>
    <div class="content-wrapper " style="background-color: white;">
        <div class="container mt-5" style="background-color: white;">
            <h2>Edit Profile</h2>
            <form action="/edit_profile_process.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address:</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="mb-3">
                    <label for="mobile" class="form-label">Telephone Number:</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile; ?>">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</body>

</html>