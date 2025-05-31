<?php
include_once('../../config/database.php');

if(isset($_GET['masv'])) {
    $masv = mysqli_real_escape_string($conn, $_GET['masv']);
    //
    mysqli_begin_transaction($conn);
    try {
        // xóa thông báo trước
        $sql_delete_thongbao = "DELETE FROM thongbao WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_thongbao);
        // xóa chi tiết đăng ký
        $sql_delete_dangky = "DELETE FROM dangky WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_dangky);
        // xóa tt trả phòng
        $sql_delete_traphong = "DELETE FROM traphong WHERE MaSV='$masv'";
        mysqli_query($conn, $sql_delete_traphong);
        // delete student
        $sql_delete_sinhvien = "DELETE FROM sinhvien WHERE MaSV='$masv'";
        if(!mysqli_query($conn, $sql_delete_sinhvien)) {
            throw new Exception("Không thể xóa thông tin sinh viên");
        }
        mysqli_commit($conn);
        header('location:../index.php?action=sinhvien&view=all&thongbao=xoa');
        exit();
    } catch (Exception $e) {
        // Nếu có lỗi thì rollback
        mysqli_rollback($conn);
        header('location:../index.php?action=sinhvien&view=all&thongbao=loi');
        exit();
    }
} else {
    // Nếu không có mã sinh viên được truyền vào
    header('location:../index.php?action=sinhvien&view=all&thongbao=loi');
    exit();
}
?>