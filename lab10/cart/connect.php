<?php
try {

$pdo = new PDO("mysql:localhost=host; dbname=sec2_17; charset=utf8", "Tstd17", "H8e7Dyqq");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>