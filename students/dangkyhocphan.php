<?php
// Kết nối database
$mysqli = new mysqli("localhost", "root", "", "test1", 3300);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Lấy danh sách học phần đã đăng ký
$maSV = "1234567890"; // Lấy từ session hoặc input form đăng nhập
$sql = "SELECT * FROM DangKyHocPhan WHERE MaSV = '$maSV'";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Học Phần</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 60%; margin: 20px auto; border-collapse: collapse; }
        th, td { padding: 10px; text-align: center; border: 1px solid #ddd; }
        th { background-color: #f4f4f4; }
        .btn { padding: 5px 10px; text-decoration: none; border-radius: 5px; color: white; }
        .btn-delete { background-color: red; }
        .btn-clear { background-color: darkorange; }
    </style>
</head>
<body>

    <h2 style="text-align:center;">Đăng Ký Học Phần</h2>
    <table>
        <tr>
            <th>MaHP</th>
            <th>Tên Học Phần</th>
            <th>Số Chỉ Chỉ</th>
            <th>Hành Động</th>
        </tr>
        <?php 
        $totalCredits = 0;
        while ($row = $result->fetch_assoc()): 
            $totalCredits += $row['SoChiChi'];
        ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHocPhan']; ?></td>
                <td><?php echo $row['SoChiChi']; ?></td>
                <td>
                    <a href="delete_hocphan.php?id=<?php echo $row['ID']; ?>" class="btn btn-delete">Xóa</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <p style="text-align:center;">Tổng số tín chỉ: <b><?php echo $totalCredits; ?></b></p>
    <div style="text-align:center;">
        <a href="delete_all_hocphan.php" class="btn btn-clear">Xóa Đăng Ký</a>
    </div>

</body>
</html>

<?php $mysqli->close(); ?>
