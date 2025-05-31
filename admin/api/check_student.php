<?php
header('Content-Type: application/json');
include_once('../../config/database.php');

$masv = isset($_GET['masv']) ? $_GET['masv'] : '';
$response = ['exists' => false, 'message' => ''];

if ($masv) {
    // Sử dụng prepared statement để tránh SQL injection
    $sql = "SELECT COUNT(*) as count FROM sinhvien WHERE MaSV = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $masv);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $response['exists'] = ($row['count'] > 0);
    $response['message'] = $response['exists'] ? 
        'Mã sinh viên đã tồn tại' : 'Mã sinh viên hợp lệ';
}

echo json_encode($response);
