<?php include "connect.php" ?>

<?php
// Update the member's information without changing the username
$stmt = $pdo->prepare("UPDATE member SET password=?, name=?, address=?, mobile=?, email=? WHERE username=?");
$stmt->bindParam(1, $_POST["password"]);
$stmt->bindParam(2, $_POST["name"]);
$stmt->bindParam(3, $_POST["address"]);
$stmt->bindParam(4, $_POST["mobile"]);
$stmt->bindParam(5, $_POST["email"]);
$stmt->bindParam(6, $_POST["username"]); // Use username for WHERE clause

$pid = $pdo->lastInsertId(); // ขอคีย์หลักที่เพิ่มสำเร็จ

header("location: databaseW5.php?username=" . $username);
?>
