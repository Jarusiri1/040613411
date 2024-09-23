<?php include "connect.php" ?>
<html>

<head>
    <meta charset="utf-8">
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute();
    while ($row = $stmt->fetch()) {
        echo "username: " . $row["username"] . "<br>";
        echo "password: " . $row["password"] . "<br>";
        echo "name: " . $row["name"] . "<br>";
        echo "address: " . $row["address"] . " <br>";
        echo "mobile: " . $row["mobile"] . " <br>";
        echo "email: " . $row["email"] . " <br>";
        echo "<a href='edit-form.php?username=" . $row["username"] . "'>แก้ไข</a>";
        echo "<hr>\n";
    }
    ?>
</body>

</html>