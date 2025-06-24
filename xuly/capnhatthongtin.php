<?php
session_start();
include_once('../config/database.php');
if(isset($_POST['sv_capnhattt'])) {
    $masv = $_POST['masv'];
    $ns = $_POST['ns'];
    $dc = $_POST['dc'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if(!empty($pass)) {
        // Cập nhật cả mật khẩu
        $sql = "UPDATE sinhvien SET 
                NgaySinh='$ns',
                DiaChi='$dc',
                SDT='$sdt',
                Email='$email',
                MatKhau='$pass'
                WHERE MaSV='$masv'";
    } else {
        // Chỉ cập nhật thông tin, không cập nhật mật khẩu
        $sql = "UPDATE sinhvien SET 
                NgaySinh='$ns',
                DiaChi='$dc',
                SDT='$sdt',
                Email='$email'
                WHERE MaSV='$masv'";
    }
    $rs = mysqli_query($conn, $sql);
    if($rs){
        // Cập nhật session với thông tin mới
        $sql = "SELECT * FROM sinhvien WHERE MaSV='$masv'";
        $result = mysqli_query($conn, $sql);
        $_SESSION['sv_login'] = mysqli_fetch_array($result);
        header('location:../index.php?action=capnhatthongtin&tb=ok');
    } else {
        header('location:../index.php?action=capnhatthongtin&tb=loi');
    }
}
?>
