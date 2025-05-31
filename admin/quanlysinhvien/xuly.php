<?php
session_start();
include_once('../../config/database.php');
if(isset($_GET['action'])){
    $action=$_GET['action'];
    switch ($action) {
        case 'Thêm':
            $masv=$_GET['masv'];
            $ten=$_GET['ten'];
            $ns=$_GET['ns'];
            $gt=$_GET['gt'];
            $dc=$_GET['dc'];
            $sdt=$_GET['sdt'];
            $email= isset($_GET['email']) ? $_GET['email'] : '';
            $mk=$_GET['mk'];
            $sql="insert into sinhvien(MaSV,HoTen,NgaySinh,gioiTinh,DiaChi,SDT,Email,MatKhau) value('$masv','$ten','$ns','$gt','$dc','$sdt','$email','$mk')" ;
            $rs=mysqli_query($conn,$sql);
            if($rs){
                header('location:../index.php?action=sinhvien&view=all&thongbao=them');
            }
            break;
        case 'Cập nhật':
            $masv=$_GET['masv'];
            $ten=$_GET['ten'];
            $ns=$_GET['ns'];
            $gt=$_GET['gt'];
            $dc=$_GET['dc'];
            $sdt=$_GET['sdt'];
            $email= isset($_GET['email']) ? $_GET['email'] : '';
            $sql="update sinhvien set HoTen='$ten', NgaySinh='$ns',DiaChi='$dc',SDT='$sdt',Email='$email',GioiTinh='$gt' where MaSV='$masv'" ;
            $rs=mysqli_query($conn,$sql);
            if($rs){
                header('location:../index.php?action=sinhvien&view=all&thongbao=sua');
            }
            break;
        default:
            // nothing
            break;
    }
}


?>