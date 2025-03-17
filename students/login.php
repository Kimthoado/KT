<?php
// Kết nối cơ sở dữ liệu
$mysqli = new mysqli("localhost", "root", "", "test1", 3300);

// Kiểm tra kết nối
if ($mysqli->connect_error) {
    die("Kết nối thất bại: " . $mysqli->connect_error);
}

// Xử lý đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $masv = $_POST["masv"];

    // Kiểm tra xem sinh viên có tồn tại không
    $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $masv);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Đăng nhập thành công
        session_start();
        $_SESSION["MaSV"] = $masv;
        header("Location: student_dashboard.php"); // Chuyển hướng đến trang quản lý sinh viên
        exit();
    } else {
        $error = "Mã sinh viên không hợp lệ!";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: Arial, sans-serif;
        }
        .login-container {
            width: 400px;
            margin: 100px auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px 0px #0000001a;
        }
    </style>
</head>
<body>

<div class="login-container">
    <h2 class="text-center">ĐĂNG NHẬP</h2>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form action="" method="post">
        <div class="mb-3">
            <label class="form-label">MaSV</label>
            <input type="text" name="masv" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng Nhập</button>
    </form>
    <div class="mt-3">
        <a href="index.php" class="text-decoration-none">Back to List</a>
    </div>
</div>

</body>
</html>
