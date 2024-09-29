<?php
session_start();
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่ามีสินค้าในตะกร้าหรือไม่
if (!empty($_SESSION['cart'])) {
    try {
        // เริ่มต้น transaction
        $pdo->beginTransaction();

        // 1. สร้างคำสั่งซื้อใหม่ในตาราง orders
        $stmt = $pdo->prepare("INSERT INTO orders (username, ord_date, status) VALUES (?, NOW(), 'pay')");
        $stmt->execute([$_SESSION['username']]);

        // ดึงค่า ord_id ที่เพิ่งถูกสร้างขึ้น
        $order_id = $pdo->lastInsertId();

        // 2. วนลูปผ่านสินค้าทุกชิ้นในตะกร้าและบันทึกในตาราง item
        foreach ($_SESSION['cart'] as $pid => $item) {
            // บันทึกสินค้าลงในตาราง item
            $item_stmt = $pdo->prepare("INSERT INTO item (ord_id, pid, quantity) VALUES (?, ?, ?)");
            $item_stmt->execute([$order_id, $pid, $item['qty']]);

            // อัปเดตจำนวนสินค้าคงเหลือในตาราง product
            $update_stock_stmt = $pdo->prepare("UPDATE product SET stock = stock - ? WHERE pid = ?");
            $update_stock_stmt->execute([$item['qty'], $pid]);
        }

        // ล้างตะกร้าสินค้าหลังบันทึกคำสั่งซื้อสำเร็จ
        $_SESSION['cart'] = array();

        // คอมมิต transaction
        $pdo->commit();

        echo "บันทึกคำสั่งซื้อสำเร็จ!";

        // เพิ่มปุ่มกลับไปหน้าตะกร้า
        echo '<br><a href="../cart"><button>กลับไปหน้าเลือกสินค้า</button></a>';
    } catch (Exception $e) {
        // ย้อนกลับ transaction ในกรณีที่เกิดข้อผิดพลาด
        $pdo->rollBack();
        echo "เกิดข้อผิดพลาด: " . $e->getMessage();
    }
} else {
    echo "ตะกร้าสินค้าว่างเปล่า!";
}
?>
