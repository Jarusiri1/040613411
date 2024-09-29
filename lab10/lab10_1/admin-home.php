<html>
<head>
    <meta charset="utf-8">
    <title>Admin Home</title>
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

    echo "<h1>สวัสดีผู้ดูแลระบบ " . $_SESSION["fullname"] . "</h1>";
    echo "<h2>ที่อยู่: " . $_SESSION["address"] . "</h2>";
    echo "<hr>";
    echo "<br><a href='../cart'>ไปหน้าตะกร้า</a>";
    
    echo "<h3>จำนวนคำสั่งซื้อของสมาชิกแต่ละคน:</h3>";

    // แสดงจำนวนคำสั่งซื้อของสมาชิกแต่ละคน
    $stmt = $pdo->query("
        SELECT member.username, member.name, COUNT(orders.ord_id) AS order_count 
        FROM orders 
        JOIN member ON orders.username = member.username
        GROUP BY member.username, member.name
    ");

    if ($stmt->rowCount() > 0) {
        echo "<ul>";
        while ($row = $stmt->fetch()) {
            echo "<li>";
            echo "ชื่อสมาชิก: " . htmlspecialchars($row["name"]) . "<br>";
            echo "จำนวนคำสั่งซื้อ: <a href='admin-orders.php?username=" . urlencode($row['username']) . "'>" . htmlspecialchars($row["order_count"]) . "</a><br>";
            echo "</li><hr>";
        }
        echo "</ul>";
    } else {
        echo "ไม่มีคำสั่งซื้อในระบบ";
    }

    echo "หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>";
    ?>
</body>
</html>
