<?php
include '../connect.php';  // เรียกไฟล์เชื่อมต่อฐานข้อมูล

if (isset($_GET["username"])) {
    $username = $_GET["username"];

    // เตรียมคำสั่ง SQL เพื่อเช็คว่ามี username นี้อยู่ในระบบหรือไม่
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = :username");
    $stmt->bindParam(':username', $username);

    // รันคำสั่ง SQL
    $stmt->execute();

    // ตรวจสอบว่าพบข้อมูลหรือไม่
    if ($stmt->rowCount() > 0) {
        // ถ้าพบ username ที่ซ้ำ
        echo "denied";
    } else {
        // ถ้าไม่พบ username แสดงว่าสามารถใช้ได้
        echo "okay";
    }
}
?>
