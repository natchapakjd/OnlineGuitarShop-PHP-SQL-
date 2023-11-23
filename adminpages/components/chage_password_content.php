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

        <div class="container mt-5">
            <h2>Change password</h2>
            <form action="/changepass_process.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" disabled>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">New Password:</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>

                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password:</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>

                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>
</body>

</html>