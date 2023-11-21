<?php
include("./helpers/db.php");
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];

    // คำสั่ง SQL สำหรับอัปเดตข้อมูล
    $sql = "UPDATE users SET name = :name, email = :email, address = :address, mobile = :mobile WHERE id = :user_id";
    
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':mobile', $mobile);

    if ($stmt->execute()) {
        // อัปเดตข้อมูลสำเร็จ
        if($_SESSION['role'] === 'admin'){
            header("Location: adminpages/index.php"); // หรือไปยังหน้าที่ต้องการหลังจากอัปเดต
        }else{
            header("Location: edit_profile.php"); // หรือไปยังหน้าที่ต้องการหลังจากอัปเดต

        }
        exit();
    } else {
        echo "Error updating record";
    }
} else {
    // ถ้าไม่ใช่การส่งคำขอแบบ POST ให้เปิดหน้าเพจใหม่หรือทำการจัดการตามที่เหมาะสม
    header("Location: edit_profile.php");
    exit();
}
?>
