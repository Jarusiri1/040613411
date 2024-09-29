<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <div style="display:flex">
        <?php
        $stmt = $pdo->prepare("SELECT * FROM member");
        $stmt->execute();
        ?>
        <?php while ($row = $stmt->fetch()) : ?>
            <div style="padding: 15px; text-align: center">
                <a href="detail-member.php?username=<?= $row["username"] ?>">
                    <img src='mphoto/<?= $row["username"] ?>.jpg' width='100'>
                </a><br>
                <?= $row["name"] ?><br>
                <?= $row["address"] ?><br>
                <?= $row["email"] ?>
            </div>
        <?php endwhile; ?>
    </div>
</body>

</html>