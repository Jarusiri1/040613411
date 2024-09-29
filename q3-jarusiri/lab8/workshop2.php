<?php include "w1.php" ?>
<html>
<head><meta charset="utf-8"></head>
<body>
<?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "ชื่อสมชิก : " . $row ["name"] . "<br>";
        echo "ที่อยู๋: " . $row ["address"] . "<br>";
        echo "อีเมลล์ : " . $row ["email"] . "<br>";
        echo "<hr>\n";
    }
?>
</body>
</html>