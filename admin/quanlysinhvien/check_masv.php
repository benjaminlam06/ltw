<?php
include_once('../../config/database.php'); // sửa lại đúng đường dẫn của bạn

if (isset($_GET['masv'])) {
    $masv = mysqli_real_escape_string($conn, $_GET['masv']);
    $sql = "SELECT MaSV FROM sinhvien WHERE MaSV = '$masv'";
    $rs = mysqli_query($conn, $sql);

    if (mysqli_num_rows($rs) > 0) {
        echo 'exist';
    } else {
        echo 'ok';
    }
}
?>
