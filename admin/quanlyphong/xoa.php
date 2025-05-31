<?php
include_once('../../config/database.php');

if(isset($_GET['map'])) {
    $maphong = $_GET['map'];
    
    // Bắt đầu transaction
    mysqli_begin_transaction($conn);
    
    try {
        // Bước 1: Xóa dữ liệu từ bảng chitietchuyenphong liên quan đến phòng
        $sql_delete_ctcp_to = "DELETE FROM chitietchuyenphong WHERE MaPhongO = '$maphong'";
        mysqli_query($conn, $sql_delete_ctcp_to);
        
        $sql_delete_ctcp_from = "DELETE FROM chitietchuyenphong WHERE MaPhongChuyen = '$maphong'";
        mysqli_query($conn, $sql_delete_ctcp_from);
        
        // Bước 2: Xóa dữ liệu từ bảng chitietdangky
        $sql_delete_ctdk = "DELETE FROM chitietdangky WHERE MaPhong = '$maphong'";
        mysqli_query($conn, $sql_delete_ctdk);
        
        // Bước 3: Xóa dữ liệu từ bảng Phong_o (nếu có)
        $sql_delete_phong_o = "DELETE FROM Phong_o WHERE MaPhong = '$maphong'";
        mysqli_query($conn, $sql_delete_phong_o);
        
        // Bước 4: Cuối cùng xóa phòng
        $sql_delete_phong = "DELETE FROM Phong WHERE MaPhong = '$maphong'";
        mysqli_query($conn, $sql_delete_phong);
        
        // Nếu tất cả câu lệnh thành công, commit transaction
        mysqli_commit($conn);
        
        echo "<script>
                alert('Xóa phòng thành công!');
                window.location.href = '../index.php?action=quanlyphong&view=quanlyphong';
              </script>";
    } catch(Exception $e) {
        // Nếu có lỗi, rollback tất cả thay đổi
        mysqli_rollback($conn);
        
        echo "<script>
                alert('Không thể xóa phòng. Vui lòng kiểm tra lại!');
                window.location.href = '../index.php?action=quanlyphong&view=quanlyphong';
              </script>";
    }
} else {
    header('Location: ../index.php?action=quanlyphong&view=quanlyphong');
}
?>