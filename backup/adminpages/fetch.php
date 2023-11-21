<?php
$pdo = new PDO("mysql:host=localhost:8889;dbname=blueshop;charset=utf8", "root", "0874884820.Ab");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$stmt = $pdo->prepare("SELECT * FROM product");

$stmt->execute();

while ($row = $stmt->fetch()) { // ดึงข ้อมูลทีละแถวเก็บไว ้ใน $row
echo "<pre>";
print_r($row); // ค าสงแสดงค่าในอาร์ ั่ เรย์
echo "</pre>";
}
