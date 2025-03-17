<?php
$mysqli = new mysqli("localhost", "root", "", "test1", 3300);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM DangKyHocPhan WHERE ID = $id";
    if ($mysqli->query($sql) === TRUE) {
        header("Location: dangkyhocphan.php");
    } else {
        echo "Lỗi: " . $mysqli->error;
    }
}

$mysqli->close();
?>
