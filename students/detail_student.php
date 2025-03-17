<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "testt");

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Lấy mã sinh viên từ URL
if (isset($_GET['id'])) {
    $maSV = $_GET['id'];
} else {
    echo "Mã sinh viên không hợp lệ!";
    exit;
}

// Lấy thông tin chi tiết sinh viên từ cơ sở dữ liệu
$sql = "SELECT * FROM SinhVien WHERE MaSV = '$maSV'";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Sinh viên không tồn tại!";
    exit;
}

$mysqli->close();  // Đóng kết nối
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Sinh Viên</title>
</head>
<body>
    <h1>Chi Tiết Sinh Viên</h1>
    <table>
        <tr>
            <th>Mã Sinh Viên</th>
            <td><?php echo $row['MaSV']; ?></td>
        </tr>
        <tr>
            <th>Họ Tên</th>
            <td><?php echo $row['HoTen']; ?></td>
        </tr>
        <tr>
            <th>Giới Tính</th>
            <td><?php echo $row['GioiTinh']; ?></td>
        </tr>
        <tr>
            <th>Ngày Sinh</th>
            <td><?php echo $row['NgaySinh']; ?></td>
        </tr>
        <tr>
            <th>Hình Ảnh</th>
            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($row['Hinh']); ?>" width="100" height="100"></td>
        </tr>
        <tr>
            <th>Mã Ngành</th>
            <td><?php echo $row['MaNganh']; ?></td>
        </tr>
    </table>
    <a href="index.php">Quay lại danh sách sinh viên</a>
</body>
</html>