<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "test1",3300);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $maSV = $_POST['MaSV'];
    $hoTen = $_POST['HoTen'];
    $gioiTinh = $_POST['GioiTinh'];
    $ngaySinh = $_POST['NgaySinh'];
    $maNganh = $_POST['MaNganh'];

    // Kiểm tra nếu có tệp hình ảnh
    if ($_FILES['Hinh']['error'] == 0) {
        $hinh = addslashes(file_get_contents($_FILES['Hinh']['tmp_name']));
    } else {
        $hinh = null; // Nếu không có ảnh, lưu NULL
    }

    // Kết nối cơ sở dữ liệu
    $mysqli = new mysqli("localhost", "root", "", "test1", 3300);
    
    if ($mysqli->connect_error) {
        die("Kết nối thất bại: " . $mysqli->connect_error);
    }

    // Chèn sinh viên vào cơ sở dữ liệu
    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssssb", $maSV, $hoTen, $gioiTinh, $ngaySinh, $hinh, $maNganh);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success text-center'>Thêm sinh viên thành công!</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Lỗi: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Thêm Sinh Viên</h2>
        <form method="POST" enctype="multipart/form-data" class="p-4 border rounded shadow bg-light">
            <div class="mb-3">
                <label for="MaSV" class="form-label">Mã Sinh Viên:</label>
                <input type="text" id="MaSV" name="MaSV" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="HoTen" class="form-label">Họ Tên:</label>
                <input type="text" id="HoTen" name="HoTen" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="GioiTinh" class="form-label">Giới Tính:</label>
                <select id="GioiTinh" name="GioiTinh" class="form-control">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="NgaySinh" class="form-label">Ngày Sinh:</label>
                <input type="date" id="NgaySinh" name="NgaySinh" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="Hinh" class="form-label">Hình Ảnh:</label>
                <input type="file" id="Hinh" name="Hinh" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="MaNganh" class="form-label">Mã Ngành:</label>
                <input type="text" id="MaNganh" name="MaNganh" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Thêm</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
