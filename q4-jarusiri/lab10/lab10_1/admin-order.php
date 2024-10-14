<html>
<head>
    <meta charset="utf-8">
    <title>Admin Orders</title>
</head>
<body>
    <?php
    session_start();
    include 'connect.php';

    // ตรวจสอบว่า role เป็น admin หรือไม่
    if ($_SESSION["role"] != 'admin') {
        header("location: login-form.php");
        exit();
    }

    echo "<h1>รายการคำสั่งซื้อของสมาชิก: " . htmlspecialchars($_GET['username']) . "</h1>";

    // ดึงคำสั่งซื้อของผู้ใช้ที่เลือก
    $stmt = $pdo->prepare("
        SELECT orders.ord_id, orders.ord_date, orders.status 
        FROM orders 
        WHERE orders.username = ?
        ORDER BY orders.ord_date DESC
    ");
    $stmt->execute([$_GET['username']]);

    if ($stmt->rowCount() > 0) {
        echo "<ul>";
        while ($order = $stmt->fetch()) {
            echo "<li>";
            echo "Order ID: " . htmlspecialchars($order["ord_id"]) . "<br>";
            echo "Date: " . htmlspecialchars($order["ord_date"]) . "<br>";
            echo "Status: " . htmlspecialchars($order["status"]) . "<br>";

            // ดึงสินค้าที่สั่งในคำสั่งซื้อนี้
            $item_stmt = $pdo->prepare("
                SELECT product.pname, item.quantity
                FROM item
                JOIN product ON item.pid = product.pid
                WHERE item.ord_id = ?
            ");
            $item_stmt->execute([$order["ord_id"]]);

            if ($item_stmt->rowCount() > 0) {
                while ($item = $item_stmt->fetch()) {
                    echo "ชื่อสินค้า: " . htmlspecialchars($item["pname"]) . "<br>";
                    echo "จำนวนที่สั่งซื้อ: " . htmlspecialchars($item["quantity"]) . "<br>";
                }
            } else {
                echo "ไม่มีรายการสินค้าสำหรับคำสั่งซื้อนี้";
            }
            echo "</li><hr>";
        }
        echo "</ul>";
    } else {
        echo "ไม่มีคำสั่งซื้อสำหรับผู้ใช้นี้";
    }

    echo "<a href='admin-home.php'>กลับไปหน้าผู้ดูแลระบบ</a>";
    ?>
</body>
</html>
