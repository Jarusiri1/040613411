<?php 
include "connect.php"; 
session_start(); 
?>

<html>
<head><meta charset="utf-8"></head>
<?php
   // ดึงข้อมูลสินค้าตามรหัสสินค้า
   $stmt = $pdo->prepare("SELECT * FROM product WHERE pid = ?");
   $stmt->bindParam(1, $_GET["pid"]);  
   $stmt->execute(); 	
   $row = $stmt->fetch();
?>

<a href="cart.php?action=">สินค้าในตะกร้า (<?=sizeof($_SESSION['cart'])?>)</a>
<div style="display:flex">
<div>
     <img src='img/<?=$row["pid"]?>.jpg' width='200'>
</div>
<div style="padding: 15px">
    <h2><?=$row["pname"]?></h2>
    รายละเอียดสินค้า: <?=$row["pdetail"]?><br>
    ราคาขาย <?=$row["price"]?> บาท<br>

    <!-- เฉพาะ admin เท่านั้นที่สามารถเห็นจำนวนสินค้าคงเหลือ -->
    <?php if ($_SESSION["role"] == 'admin') { ?>
        จำนวนสินค้าคงเหลือ: <?=$row["stock"]?> ชิ้น<br>
    <?php } ?>

    <form method="post" action="cart.php?action=add&pid=<?=$row["pid"]?>&pname=<?=$row["pname"]?>&price=<?=$row["price"]?>">
        <input type="number" name="qty" value="1" min="1" max="<?=$row['stock']?>"> <!-- max ตามจำนวนสินค้าคงเหลือ -->
        <input type="submit" value="เพิ่ม">	   
    </form>
</div>
</div>
</body>
</html>
