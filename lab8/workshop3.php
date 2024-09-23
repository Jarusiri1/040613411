<?php include "w1.php"; ?>
<!DOCTYPE html>
<html lang="en">
<body>
<?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        ?>
            ชื่อสมาชิก: <?=$row["name"]?><br>
            ที่อยู่: <?=$row["address"]?><br>
            อีเมล: <?=$row["email"]?><br>
            <img src="mphoto/<?=$row["id"]?>.jpg" width="100">
            <hr>
        <?php }?>
</body>
</html>