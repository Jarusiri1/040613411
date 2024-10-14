<?php
    session_start();
    // ลบ session id ในคุกกีเค้ รี่องผู้ใช้
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]

    );
    session_destroy(); // ท าลาย session
?>

ออกจากระบบสำเร็จแล้ว <br>
หากต้องการเข้าสูระบบอีกครั้งโปรดคลิ้ก
<a href='login-form.php'>เข้าสู่ระบบ </a>