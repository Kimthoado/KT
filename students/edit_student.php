<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "test1",3300);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Kiểm tra id sinh viên hợp lệ
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Mã sinh viên không hợp lệ!";
    exit;
}
$maSV = $_GET['id'];

// Lấy thông tin sinh viên bằng Prepared Statement
$sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("s", $maSV);
$stmt->execute();
$result = $stmt->get_result();

// Nếu không tìm thấy sinh viên
if ($result->num_rows === 0) {
    echo "Sinh viên không tồn tại!";
    exit;
}
$row = $result->fetch_assoc();

// Xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];
    $target_file = $row['Hinh']; // Giữ ảnh cũ nếu không có ảnh mới

    // Nếu có upload ảnh mới
    if ($_FILES['Hinh']['error'] == 0) {
        $target_dir = "uploads/";  // Thư mục lưu ảnh
        $target_file = $target_dir . basename($_FILES["Hinh"]["name"]);
        move_uploaded_file($_FILES["Hinh"]["tmp_name"], $target_file);
    }

    // Cập nhật thông tin sinh viên (Prepared Statement)
    $sql_update = "UPDATE SinhVien SET HoTen = ?, GioiTinh = ?, NgaySinh = ?, Hinh = ?, MaNganh = ? WHERE MaSV = ?";
    $stmt = $mysqli->prepare($sql_update);
    $stmt->bind_param("ssssis", $hoTen, $gioiTinh, $ngaySinh, $target_file, $maNganh, $maSV);

    if ($stmt->execute()) {
        header("Location: index.php"); // Chuyển về trang danh sách sau khi cập nhật
        exit();
    } else {
        echo "<div class='alert alert-danger'>Lỗi cập nhật: " . $stmt->error . "</div>";
    }
}
$mysqli->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { max-width: 500px; margin-top: 50px; background: white; padding: 20px; border-radius: 10px; }
        img { display: block; margin: 10px 0; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center">Chỉnh Sửa Sinh Viên</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên</label>
                <input type="text" id="MaSV" name="MaSV" class="form-control" value="<?= $row['MaSV']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên</label>
                <input type="text" id="HoTen" name="HoTen" class="form-control" value="<?= $row['HoTen']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính</label>
                <select id="GioiTinh" name="GioiTinh" class="form-select" required>
                    <option value="Nam" <?= $row['GioiTinh'] == 'Nam' ? 'selected' : ''; ?>>Nam</option>
                    <option value="Nữ" <?= $row['GioiTinh'] == 'Nữ' ? 'selected' : ''; ?>>Nữ</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh</label>
                <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" value="<?= $row['NgaySinh']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình Ảnh</label>
                <input type="file" id="Hinh" name="Hinh" class="form-control">
                <?php if (!empty($row['Hinh'])): ?>
                    <img src="<?= $row['Hinh']; ?>" width="100">
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành</label>
                <input type="text" id="MaNganh" name="MaNganh" class="form-control" value="<?= $row['MaNganh']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Cập Nhật</button>
        </form>
    </div>
</body>
</html>
