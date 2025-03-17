<?php
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "test1", 3300);

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Lấy ID học phần cần xóa
    $sql = "DELETE FROM hocphan WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: hocphan.php"); // Chuyển hướng về trang học phần sau khi xóa
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>
