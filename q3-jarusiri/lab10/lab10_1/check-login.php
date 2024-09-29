<?php
session_start();
include 'connect.php';

// ตรวจสอบว่ามีการส่ง username และ password หรือไม่
if (isset($_POST["username"]) && isset($_POST["password"])) {
    // เตรียมคำสั่ง SQL เพื่อเช็คข้อมูลผู้ใช้
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username = ? AND password = ?");
    $stmt->execute([$_POST["username"], $_POST["password"]]);

    $row = $stmt->fetch();

    // ถ้า username และ password ตรงกับในฐานข้อมูล
    if ($row) {
        // เก็บข้อมูลใน session
        $_SESSION["username"] = $row["username"];
        $_SESSION["fullname"] = $row["name"];
        $_SESSION["address"] = $row["address"];
        $_SESSION["role"] = $row["role"];

        // ตรวจสอบ role ของผู้ใช้
        if ($row["role"] == "member") {
            // ถ้าเป็นสมาชิกปกติ เปลี่ยนเส้นทางไปที่ user-home.php
            header("location: user-home.php");
            exit();
        } elseif ($row["role"] == "admin") {
            // ถ้าเป็นผู้ดูแลระบบ เปลี่ยนเส้นทางไปที่ admin-home.php
            header("location: admin-home.php");
            exit();
        }
    } else {
        echo "Username หรือ Password ไม่ถูกต้อง";
        echo "<a href='login-form.php'>ลองอีกครั้ง</a>";
    }
} else {
    echo "กรุณากรอก Username และ Password";
}
?>
