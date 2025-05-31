<?php
header('Content-Type: application/json');
session_start();
include_once('../../config/database.php');
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Log dữ liệu nhận được
file_put_contents('ajax_log.txt', date('Y-m-d H:i:s') . " - POST: " . print_r($_POST, true) . "\n", FILE_APPEND);
$response = ['success' => false, 'message' => '', 'data' => null];

if(isset($_POST['action']) && $_POST['action'] == 'Thêm'){
    $masv = $_POST['masv'];
    $ten = $_POST['ten'];
    $ns = $_POST['ns'];
    $gt = $_POST['gt'];
    $dc = $_POST['dc'];
    $sdt = $_POST['sdt'];
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mk = $_POST['mk'];

    // Kiểm tra dữ liệu
    if(empty($masv) || empty($ten)) {
        $response['message'] = 'Vui lòng điền đầy đủ thông tin bắt buộc';
        echo json_encode($response);
        exit;
    }
    // Kiểm tra mã sinh viên tồn tại
    $checkSql = "SELECT COUNT(*) as count FROM sinhvien WHERE MaSV = '$masv'";
    $checkResult = mysqli_query($conn, $checkSql);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['count'] > 0) {
        $response['message'] = 'Mã sinh viên đã tồn tại';
        echo json_encode($response);
        exit;
    }
    // Thêm sinh viên mới bằng cách đơn giản
    $sql = "INSERT INTO sinhvien(MaSV,HoTen,NgaySinh,GioiTinh,DiaChi,SDT,Email,MatKhau) 
            VALUES ('$masv','$ten','$ns','$gt','$dc','$sdt','$email','$mk')";
    if(mysqli_query($conn, $sql)){
        $response['success'] = true;
        $response['data'] = [
            'MaSV' => $masv,
            'HoTen' => $ten,
            'NgaySinh' => $ns,
            'GioiTinh' => $gt,
            'DiaChi' => $dc,
            'SDT' => $sdt,
            'Email' => $email
        ];
    } else {
        $response['message'] = 'Lỗi: ' . mysqli_error($conn);
    }
}

echo json_encode($response);
