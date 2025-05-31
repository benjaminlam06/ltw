<?php
include_once('../../config/database.php');

if(isset($_GET['masv'])) {
    $masv = mysqli_real_escape_string($conn, $_GET['masv']);
    
    // Bắt đầu transaction
    mysqli_begin_transaction($conn);
    
    try {
        // 1. Xóa các thông báo liên quan
        $sql_delete_thongbao = "DELETE FROM thongbao WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_thongbao);
        
        // 2. Xóa thông tin đăng ký phòng
        $sql_delete_dangky = "DELETE FROM dangky WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_dangky);
        
        // 3. Xóa thông tin trả phòng (nếu có)
        $sql_delete_traphong = "DELETE FROM traphong WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_traphong);
        
        // 4. Cuối cùng xóa sinh viên
        $sql_delete_sinhvien = "DELETE FROM sinhvien WHERE MaSV='$masv'";
        if(!mysqli_query($conn, $sql_delete_sinhvien)) {
            throw new Exception("Không thể xóa thông tin sinh viên");
        }
        
        // Nếu tất cả thành công thì commit
        mysqli_commit($conn);
        
        // Chuyển hướng về trang danh sách với thông báo thành công
        header('location:../index.php?action=sinhvien&view=all&thongbao=xoa');
        exit();
        
    } catch (Exception $e) {
        // Nếu có lỗi thì rollback
        mysqli_rollback($conn);
        // Chuyển hướng về trang danh sách với thông báo lỗi
        header('location:../index.php?action=sinhvien&view=all&thongbao=loi');
        exit();
    }
} else {
    // Nếu không có mã sinh viên được truyền vào
    header('location:../index.php?action=sinhvien&view=all&thongbao=loi');
    exit();
}
?>