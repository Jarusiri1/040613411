<?php
include 'connect.php';  // รวมไฟล์การเชื่อมต่อฐานข้อมูล

// รับค่า pid จาก URL
$pid = $_GET['pid'];

// สร้างคำสั่ง SQL เพื่อดึงข้อมูลสินค้าตาม pid
$stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
$stmt->bindParam(1, $pid);
$stmt->execute();
$row = $stmt->fetch();  // ดึงข้อมูลแถวสินค้า

// แสดงผลหน้าเว็บ
?>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body>
    <div style="display: flex;">
        <div>
            <!-- แสดงภาพสินค้า -->
            <img src="pphoto/<?= $row['pid'] ?>" width="200">
        </div>
        <div style="padding: 15px;">
            <h2><?= $row['pname'] ?></h2>
            รายละเอียดสินค้า: <?= $row['pdetail'] ?><br>
            ราคาขาย <?= $row['price'] ?> บาท<br><br>
            ซื้อวันนี้ลด 10% เหลือ <?= $row['price'] * 0.9 ?> บาท
        </div>
    </div>
</body>

</html>