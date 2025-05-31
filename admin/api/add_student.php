<?php
header('Content-Type: application/json');
include_once('../../config/database.php');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log request data
$requestData = file_get_contents('php://input');
file_put_contents('add_student_log.txt', date('Y-m-d H:i:s') . " - POST data: " . print_r($_POST, true) . "\n", FILE_APPEND);

$response = ['success' => false, 'message' => '', 'data' => null, 'debug' => ['post' => $_POST, 'request' => $requestData]];

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
    $checkSql = "SELECT COUNT(*) as count FROM sinhvien WHERE MaSV = ?";
    $checkStmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($checkStmt, "s", $masv);
    mysqli_stmt_execute($checkStmt);
    $checkResult = mysqli_stmt_get_result($checkStmt);
    $checkRow = mysqli_fetch_assoc($checkResult);

    if ($checkRow['count'] > 0) {
        $response['message'] = 'Mã sinh viên đã tồn tại';
        echo json_encode($response);
        exit;
    }

    // Thêm sinh viên mới
    $sql = "INSERT INTO sinhvien(MaSV,HoTen,NgaySinh,GioiTinh,DiaChi,SDT,Email,MatKhau) 
            VALUES (?,?,?,?,?,?,?,?)";

    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssss", 
        $masv, $ten, $ns, $gt, $dc, $sdt, $email, $mk);

    if(mysqli_stmt_execute($stmt)){
        $response['success'] = true;
        $response['message'] = 'Thêm sinh viên thành công';
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
