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
                                <th>Số Chỉ</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody id="hocPhanTable">
                            <tr>
                                <td>CNTT01</td>
                                <td>Lập trình C</td>
                                <td>3</td>
                                <td>
                                    <button class="btn btn-warning btn-edit">Sửa</button>
                                    <button class="btn btn-danger btn-delete">Xóa</button>
                                </td>
                            </tr>
                            <tr>
                                <td>CNTT02</td>
                                <td>Cơ sở dữ liệu</td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-warning btn-edit">Sửa</button>
                                    <button class="btn btn-danger btn-delete">Xóa</button>
                                    </td>
                            </tr>
                            <tr>
                                <td>CNTT03</td>
                                <td>Thiet ke web</td>
                                <td>2</td>
                                <td>
                                    <button class="btn btn-warning btn-edit">Sửa</button>
                                    <button class="btn btn-danger btn-delete">Xóa</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="mt-3">
                        <p><strong>Số học phần:</strong> <span id="soHocPhan">2</span></p>
                        <p><strong>Tổng số tín chỉ:</strong> <span id="tongTinChi">5</span></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Sửa học phần -->
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Chỉnh Sửa Học Phần</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <div class="mb-3">
                            <label for="editMaHP" class="form-label">Mã HP:</label>
                            <input type="text" class="form-control" id="editMaHP" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editTenHP" class="form-label">Tên Học Phần:</label>
                            <input type="text" class="form-control" id="editTenHP">
                        </div>
                        <div class="mb-3">
                            <label for="editSoTin" class="form-label">Số Chỉ:</label>
                            <input type="number" class="form-control" id="editSoTin">
                        </div>
                        <button type="submit" class="btn btn-success">Lưu Thay Đổi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const table = document.getElementById("hocPhanTable");

        // Xóa học phần
        table.addEventListener("click", function(event) {
            if (event.target.classList.contains("btn-delete")) {
                if (confirm("Bạn có chắc muốn xóa học phần này?")) {
                    const row = event.target.closest("tr");
                    row.remove();
                    updateCount();
                }
            }
        });

        // Sửa học phần
        table.addEventListener("click", function(event) {
            if (event.target.classList.contains("btn-edit")) {
                const row = event.target.closest("tr");
                const maHP = row.cells[0].innerText;
                const tenHP = row.cells[1].innerText;
                const soTin = row.cells[2].innerText;

                document.getElementById("editMaHP").value = maHP;
                document.getElementById("editTenHP").value = tenHP;
                document.getElementById("editSoTin").value = soTin;

                const modal = new bootstrap.Modal(document.getElementById("modalEdit"));
                modal.show();
            }
        });

        // Cập nhật học phần sau khi chỉnh sửa
        document.getElementById("editForm").addEventListener("submit", function(event) {
            event.preventDefault();
            const maHP = document.getElementById("editMaHP").value;
            const tenHP = document.getElementById("editTenHP").value;
            const soTin = document.getElementById("editSoTin").value;

            const rows = table.getElementsByTagName("tr");
            for (let row of rows) {
                if (row.cells[0].innerText === maHP) {
                    row.cells[1].innerText = tenHP;
                    row.cells[2].innerText = soTin;
                    break;
                }
            }

            const modal = bootstrap.Modal.getInstance(document.getElementById("modalEdit"));
            modal.hide();
        });

        // Cập nhật số học phần và tín chỉ
        function updateCount() {
            let soHocPhan = 0, tongTinChi = 0;
            const rows = table.getElementsByTagName("tr");
            for (let row of rows) {
                if (row.cells.length > 1) {
                    soHocPhan++;
                    tongTinChi += parseInt(row.cells[2].innerText);
                }
            }
            document.getElementById("soHocPhan").innerText = soHocPhan;
            document.getElementById("tongTinChi").innerText = tongTinChi;
        }
    });
</script>

</body>
</html>
