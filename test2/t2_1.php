<?php
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลรายการสินค้าพร้อมจำนวนคำสั่งซื้อ
$stmt = $pdo->query("
    SELECT product.pid, product.pname, COUNT(item.ord_id) AS order_count
    FROM product
    LEFT JOIN item ON product.pid = item.pid
    GROUP BY product.pid, product.pname
");

echo "<table border='1'>";
echo "<tr><th>Product ID</th><th>Product Name</th><th>Number of Orders</th></tr>";

// วนลูปแสดงข้อมูลสินค้าและจำนวนคำสั่งซื้อ
while ($row = $stmt->fetch()) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($row['pid']) . "</td>";
    echo "<td>" . htmlspecialchars($row['pname']) . "</td>";
    // สร้างลิงก์ที่เชื่อมไปยังหน้าที่แสดงคำสั่งซื้อของสินค้านั้น
    echo "<td><a href='product-orders.php?pid=" . ($row['pid']) . "'>" . ($row['order_count']) . "</a></td>";
    echo "</tr>";
}

echo "</table>";
?>
