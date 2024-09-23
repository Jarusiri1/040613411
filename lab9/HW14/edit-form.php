<?php include "connect.php" ?>
<?php
// 1. กำหนดคำสั่ง SQL ให้ดึงสินค้าตามรหัสสินค้า

$stmt = $pdo->prepare("SELECT * FROM member WHERE username=?");
$stmt->bindParam(1, $_GET["username"]); // 2. นำค่า username ที่ส่งมากับ URL กำหนดเป็นเงื่อนไข
$stmt->execute(); // 3. เริ่มค้นหา
$row = $stmt->fetch(); // 4. ดึงผลลัพธ์ (เนื่องจากมีข้อมูล 1 แถวจึงเรียกเมธอด fetch เพียงครั้งเดียว)
?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <form action="success-edit.php" method="post">
        username: <input type="text" name="username" value="<?= $row["username"] ?>"><br />
        password: <input type="text" name="password" value="<?= $row["password"] ?>"><br />
        ชื่อสมาชิก: <input type="text" name="name" value="<?= $row["name"] ?>"><br />
        ที่อยู่: <input type="text" name="address" value="<?= $row["address"] ?>"><br />
        เบอร์โทรศัพท์: <input type="text" name="mobile" value="<?= $row["mobile"] ?>"><br />
        อีเมลล์: <input type="text" name="email" value="<?= $row["email"] ?>"><br />
        เลือกรูปภาพสมาชิก <input type="file" name="product_image" /><br /><br>
        <input type="submit" value="แก้ไขสมาชิก " />
    </form>
</body>

</html>