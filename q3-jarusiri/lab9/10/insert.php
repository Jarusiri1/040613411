<?php include "connect.php" ?>
<?php
$stmt = $pdo->prepare("INSERT INTO product (pname, pdetail, price) VALUES (?, ?, ?)");
$stmt->bindParam(1, $_POST["pname"]);
$stmt->bindParam(2, $_POST["pdetail"]);
$stmt->bindParam(3, $_POST["price"]);
$stmt->execute(); // เริ่มเพิ่มข้อมูล
$pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มสำเร็จ

header("location: info-product.php?pid=" . $pid);
?>