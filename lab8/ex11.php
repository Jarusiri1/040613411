<?php include "w1.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
$stmt = $pdo->prepare("SELECT * FROM product");
$stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "รหัสสินค้า: ". $row ["pid"] . "<br>";
        echo "ชื่อสินค้า: " . $row ["pname"] . "<br>";
        echo "รายละเอียดสินค้า : " . $row ["pdetail"] . "<br>";
        echo "ราคา: " . $row ["price"] . " บาท <br>";
        echo "<hr>\n";
}
?>
</body>
</html>