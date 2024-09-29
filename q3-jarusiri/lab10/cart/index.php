<?php 
include "connect.php"; 
session_start(); 
?>

<html>
<body>
    <?php
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    ?>
    <a href="cart.php?action=">สินค้าในตะกร้า (<?=sizeof($_SESSION['cart'])?>)</a>
    <div style="display:flex">	
    <?php
        $stmt = $pdo->prepare("SELECT * FROM product");
        $stmt->execute();
        while ($row = $stmt->fetch()) { 
    ?>
        <div style="padding: 15px; text-align: center">
            <a href="detail.php?pid=<?=$row["pid"]?>">
                <img src='img/<?=$row["pid"]?>.jpg' width='100'></a><br>
            <?=$row["pname"]?><br><?=$row["price"]?> บาท<br>

            <!-- เฉพาะ admin เท่านั้นที่สามารถเห็นจำนวนสินค้าคงเหลือ -->
            <?php if ($_SESSION["role"] == 'admin') { ?>
                จำนวนสินค้าคงเหลือ: <?=$row["stock"]?> ชิ้น<br>
            <?php } ?>

            <form method="post" action="cart.php?action=add&pid=<?=$row["pid"]?>&pname=<?=$row["pname"]?>&price=<?=$row["price"]?>">
                <input type="number" name="qty" value="1" min="1" max="<?=$row['stock']?>"> <!-- max ตามจำนวนสินค้าคงเหลือ -->
                <input type="submit" value="เพิ่ม">	   
            </form>
        </div>
    <?php } ?>
    </div>
</body>
</html>
