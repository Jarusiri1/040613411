<?php
include 'connect.php';

// ดึงข้อมูลสินค้าทั้งหมดจากฐานข้อมูล
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
?>

<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
<div style="display:flex;">
    <?php while ($row = $stmt->fetch()) : ?>
        <div style="padding: 15px; text-align: center;">
            <a href="detail.php?pid=<?= $row['pid'] ?>">
                <img src="pphoto/<?= $row['pid'] ?>" width="100">
            </a><br>
            <?= $row['pname'] ?><br>
            <?= $row['price'] ?> บาท
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>
