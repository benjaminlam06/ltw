<?php
include_once('../../config/database.php');

if(isset($_GET['map'])) {
    $makhu = $_GET['map'];

    // Bắt đầu transaction
    mysqli_begin_transaction($conn);

    try {
        // Bước 1: Xóa dữ liệu từ bảng Phong_o cho các phòng thuộc khu này
        $sql_delete_phong_o = "DELETE FROM Phong_o 
                              WHERE MaPhong IN (SELECT MaPhong FROM Phong WHERE MaKhu = '$makhu')";
        mysqli_query($conn, $sql_delete_phong_o);

        // Bước 2: Xóa các phòng thuộc khu này
        $sql_delete_phong = "DELETE FROM Phong WHERE MaKhu = '$makhu'";
        mysqli_query($conn, $sql_delete_phong);

        // Bước 3: Xóa khu
        $sql_delete_khu = "DELETE FROM Khu WHERE MaKhu = '$makhu'";
        mysqli_query($conn, $sql_delete_khu);

        // Nếu tất cả các câu lệnh thành công, commit transaction
        mysqli_commit($conn);

        echo "<script>
                alert('Xóa khu thành công!');
                window.location.href = '../index.php?action=khu&view=khu';
              </script>";
    } catch(Exception $e) {
        // Nếu có lỗi, rollback tất cả thay đổi
        mysqli_rollback($conn);

        echo "<script>
                alert('Không thể xóa khu. Vui lòng thử lại!');
                window.location.href = '../index.php?action=khu&view=khu';
              </script>";
    }
} else {
    header('Location: ../index.php?action=khu&view=khu');
}
?>