<?php
try {
	// $pdo = new PDO("mysql:host=localhost;dbname=blueshop;charset=utf8", "root", "");
	$pdo = new PDO("mysql:host=localhost; dbname=sec2_17; charset=utf8", "Tstd17", "H8e7Dyqq");
} catch (PDOException $e) {
	echo "เกิดข้อผิดพลาด : ".$e->getMessage();
}
?>