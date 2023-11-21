
<?php
$host = 'localhost:8889'; // เชื่อมต่อกับเซิร์ฟเวอร์ MySQL ของคุณ
$db = 'onlineguitar'; // ชื่อฐานข้อมูล
$user = 'root'; // ชื่อผู้ใช้ MySQL
$pass = '0874884820.Ab'; // รหัสผ่าน MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    // ตั้งค่า PDO เพื่อรายงานข้อผิดพลาด
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}