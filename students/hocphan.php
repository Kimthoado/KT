<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Ký Học Phần</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-4">
    <h2 class="text-center">Danh Sách Sinh Viên</h2>
    
    <button class="btn btn-success">Thêm Sinh Viên</button>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalHocPhan">Học Phần</button>

    <button class="btn btn-primary">Đăng Ký</button>
    <button class="btn btn-secondary">Đăng Nhập</button>

    <!-- Modal chứa danh sách học phần đã đăng ký -->
    <div class="modal fade" id="modalHocPhan" tabindex="-1" aria-labelledby="modalHocPhanLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalHocPhanLabel">Đăng Ký Học Phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Mã HP</th>
                                <th>Tên Học Phần</th>
                                <th>Số Chỉ Chỉ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>CNTT01</td>
                                <td>Lập trình C</td>
                                <td>3</td>
                                <td><button class="btn btn-danger">Xóa</button></td>
                            </tr>
                            <tr>
                                <td>CNTT02</td>
                                <td>Cơ sở dữ liệu</td>
                                <td>2</td>
                                <td><button class="btn btn-danger">Xóa</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <p><strong>Số học phần:</strong> 2</p>
                        <p><strong>Tổng số tín chỉ:</strong> 5</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger">Xóa Đăng Ký</button>
                    <button type="button" class="btn btn-success">Lưu Đăng Ký</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
</html>
