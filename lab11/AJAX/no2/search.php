<?php
header('Content-Type: application/json');
include 'connect.php'; // เรียกไฟล์เชื่อมต่อฐานข้อมูล

if (isset($_GET['query'])) {
    $query = trim($_GET['query']);
    
    try {
        if ($query === "") {
            // ดึงสมาชิกทั้งหมดเมื่อไม่มีการกรอกคำค้น
            $stmt = $pdo->prepare("SELECT username, image_path FROM member");
        } else {
            // ค้นหาตาม username ที่กรอก
            $stmt = $pdo->prepare("SELECT username, image_path FROM member WHERE username LIKE :query");
            $searchTerm = "%" . $query . "%";
            $stmt->bindParam(':query', $searchTerm, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        $members = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($members);
    } catch (PDOException $e) {
        // ส่งข้อความผิดพลาดหากเกิดปัญหา
        echo json_encode(['error' => $e->getMessage()]);
    }
} else {
    echo json_encode([]);
}
?>
