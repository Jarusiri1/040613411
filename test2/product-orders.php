<?php
session_start();
include 'connect.php'; // Database connection

// Check if product id is passed in URL
if (!isset($_GET['pid'])) {
    die("Product ID is missing.");
}

$pid = $_GET['pid'];

// Fetch customer orders for the specific product
$stmt = $pdo->prepare("
    SELECT member.username, orders.ord_date, item.quantity
    FROM item
    JOIN orders ON item.ord_id = orders.ord_id
    JOIN member ON orders.username = member.username
    WHERE item.pid = ?
    ORDER BY orders.ord_date DESC
");
$stmt->execute([$pid]);

// Check if there are any orders
if ($stmt->rowCount() > 0) {
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<tr><th>Customer</th><th>Order Date</th><th>Quantity Ordered</th></tr>";
    
    // Loop through the results and display them in the table
    while ($row = $stmt->fetch()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
        echo "<td>" . htmlspecialchars($row['ord_date']) . "</td>";
        echo "<td>" . htmlspecialchars($row['quantity']) . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No orders found for this product.";
}
?>
