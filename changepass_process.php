<?php
require_once './helpers/db.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $password = $_POST['password'];

    // ตรวจสอบว่ามีการรับค่า password หรือไม่
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :user_id");
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
    }

    // แก้ไขส่วนนี้ตามที่คุณต้องการ
    if ($_SESSION['role'] === 'admin') {
        header("Location: adminpages/index.php"); // หรือไปยังหน้าที่ต้องการหลังจากอัปเดต
    } else {
        header("Location: index.php"); // หรือไปยังหน้าที่ต้องการหลังจากอัปเดต
    }
    exit();
}
?>
