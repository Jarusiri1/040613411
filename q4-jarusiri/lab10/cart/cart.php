<?php
session_start();
include 'connect.php'; // เชื่อมต่อฐานข้อมูล

// เพิ่มสินค้า
if ($_GET["action"] == "add") {

    $pid = $_GET['pid'];

    // ตรวจสอบว่ามีสินค้านั้นอยู่แล้วในตะกร้าหรือไม่
    if (array_key_exists($pid, $_SESSION['cart'])) {
        $_SESSION['cart'][$pid]['qty'] += $_POST['qty'];
    } else {
        // ดึงชื่อสินค้าจากฐานข้อมูล
        $stmt = $pdo->prepare("SELECT pname FROM product WHERE pid = ?");
        $stmt->execute([$pid]);
        $product = $stmt->fetch();

        // เก็บสินค้าลงในตะกร้า
        $cart_item = array(
            'pid' => $pid,
            'pname' => $product['pname'], // เพิ่มชื่อสินค้า
            'price' => $_GET['price'],
            'qty' => $_POST['qty']
        );
        $_SESSION['cart'][$pid] = $cart_item;
    }

// ปรับปรุงจำนวนสินค้า
} else if ($_GET["action"] == "update") {
    $pid = $_GET["pid"];
    $qty = $_GET["qty"];
    $_SESSION['cart'][$pid]['qty'] = $qty;

// ลบสินค้า
} else if ($_GET["action"] == "delete") {
    $pid = $_GET['pid'];
    unset($_SESSION['cart'][$pid]);
}
?>

<html>
<head>
<script>
    // ใช้สำหรับปรับปรุงจำนวนสินค้า
    function update(pid) {
        var qty = document.getElementById(pid).value;
        // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
        document.location = "cart.php?action=update&pid=" + pid + "&qty=" + qty; 
    }
</script>
</head>
<body>
<form>
<table border="1">
<?php 
    $sum = 0;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION["cart"] as $item) {
            $sum += $item["price"] * $item["qty"];
?>
    <tr>
        <td><?=$item["pname"]?></td> <!-- แสดงชื่อสินค้า -->
        <td><?=$item["price"]?></td>
        <td>
            <input type="number" id="<?=$item["pid"]?>" value="<?=$item["qty"]?>" min="1">
            <a href="#" onclick="update(<?=$item["pid"]?>)">แก้ไข</a>
            <a href="?action=delete&pid=<?=$item["pid"]?>">ลบ</a>
        </td>
    </tr>
<?php 
        }
    }
?>
<tr><td colspan="3" align="right">รวม <?=$sum?> บาท</td></tr>
</table>
</form>

<a href="index.php">< เลือกสินค้าต่อ</a>
<br>
<!-- ปุ่มสั่งซื้อ -->
<a href="checkout.php"><button>สั่งซื้อ</button></a>
</body>
</html>
