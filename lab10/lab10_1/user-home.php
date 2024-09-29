<html>
<head>
    <meta charset="utf-8">
    <title>ประวัติการสั่งซื้อของคุณ</title>
</head>
<body>
    <?php
    include "connect.php";
    session_start();

    // ตรวจสอบว่ามีชื่อใน session หรือไม่ หากไม่มีให้ไปหน้า login อัตโนมัติ
    if (empty($_SESSION["username"])) {
        header("location: login-form.php");
        exit();
    } else {
        
        echo "<h1>รายการคำสั่งซื้อของคุณ: " . $_SESSION["fullname"] . "</h1>";
        echo "<hr>";
        echo "<br><a href='../cart'>ไปหน้าตะกร้า</a>";

        // ดึงคำสั่งซื้อของผู้ใช้
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE username = ? ORDER BY ord_date DESC");
        $stmt->execute([$_SESSION["username"]]);

        if ($stmt->rowCount() > 0) {
            echo "<ul>";

            while ($order = $stmt->fetch()) {
                echo "<li>";
                echo "Order ID: " . htmlspecialchars($order["ord_id"]) . "<br>";
                echo "Date: " . htmlspecialchars($order["ord_date"]) . "<br>";
                echo "Status: " . htmlspecialchars($order["status"]) . "<br>";

                // ดึงสินค้าที่สั่งซื้อสำหรับคำสั่งซื้อแต่ละอัน
                $item_stmt = $pdo->prepare("SELECT product.pname, item.quantity, product.stock 
                                            FROM item 
                                            JOIN product ON item.pid = product.pid 
                                            WHERE item.ord_id = ?");
                $item_stmt->execute([$order["ord_id"]]);

                if ($item_stmt->rowCount() > 0) {
                    while ($item = $item_stmt->fetch()) {
                        echo "ชื่อสินค้า: " . htmlspecialchars($item["pname"]) . "<br>";
                        echo "จำนวนที่สั่งซื้อ: " . htmlspecialchars($item["quantity"]) . "<br>";

                        // ตรวจสอบ role ถ้าเป็น admin ให้แสดงจำนวนสินค้าคงเหลือ
                        if ($_SESSION["role"] == 'admin') {
                            echo "สินค้าคงเหลือ: " . htmlspecialchars($item["stock"]) . "<br>";
                        }
                        echo "<hr>";
                    }
                } else {
                    echo "ไม่มีรายการสินค้าสำหรับคำสั่งซื้อนี้<br>";
                    echo "<hr>";
                }

                echo "</li>";
            }

            echo "</ul>";
        } else {
            echo "ไม่มีคำสั่งซื้อสำหรับผู้ใช้นี้";
        }


        echo "<br><a href='logout.php'>ออกจากระบบ</a>";
    }
    ?>
</body>
</html>
