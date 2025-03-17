<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "test1", 3300);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Lấy danh sách sinh viên
$sql = "SELECT * FROM SinhVien";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table img {
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Danh Sách Sinh Viên</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <div>
                <a href="add_student.php" class="btn btn-success">Thêm Sinh Viên</a>
                <a href="hocphan.php" class="btn btn-info">Học Phần</a>
            </div>
            <div>
                <a href="register.php" class="btn btn-primary">Đăng Ký</a>
                <a href="login.php" class="btn btn-secondary">Đăng Nhập</a>
            </div>
        </div>

        <table class="table table-bordered table-hover text-center">
            <thead class="table-dark">
                <tr>
                    <th>Mã SV</th>
                    <th>Họ Tên</th>
                    <th>Giới Tính</th>
                    <th>Ngày Sinh</th>
                    <th>Hình Ảnh</th>
                    <th>Mã Ngành</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['MaSV']; ?></td>
                        <td><?php echo $row['HoTen']; ?></td>
                        <td><?php echo $row['GioiTinh']; ?></td>
                        <td><?php echo $row['NgaySinh']; ?></td>
                        <td>
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Hinh']); ?>" width="50" height="50">
                        </td>
                        <td><?php echo $row['MaNganh']; ?></td>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                            <a href="details_student.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm">Chi Tiết</a>
                            <a href="delete_student.php?id=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php $mysqli->close(); ?>
