<?php include "w1.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <style>
        table {
            width: 30%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: center;
        }

    </style>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>รหัสสินค้า</th>
                <th>ชื่อสินค้า</th>
                <th>รายละเอียดสินค้า</th>
                <th>ราคา</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $stmt = $pdo->prepare("SELECT * FROM product");
                $stmt->execute();
                while ($row = $stmt->fetch()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["pid"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["pname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["pdetail"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["price"]) . " บาท</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>