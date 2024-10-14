<?php include "connect.php" ?>

<?php
$stmt = $pdo->prepare("UPDATE product SET pname=?, pdetail=?, price=? WHERE pid=?"); // เตรียมคำสั่ง SQL สำหรับแก้ไข
$stmt->bindParam(1, $_POST["pname"]); // กำหนดค่าลงในตำแหน่ง ?
$stmt->bindParam(2, $_POST["pdetail"]);
$stmt->bindParam(3, $_POST["price"]);
$stmt->bindParam(4, $_POST["pid"]);
$stmt->execute(); // เริ่มเพิ่มข้อมูล
$pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มสำเร็จ

header("location: info-product.php?pid=" . $pid);

?>