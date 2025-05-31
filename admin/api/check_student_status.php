<?php
header('Content-Type: application/json');

// Thử kết nối tới cơ sở dữ liệu
$dbStatus = false;
$dbError = '';

try {
    include_once('../../config/database.php');
    if ($conn) {
        $dbStatus = true;
    } else {
        $dbError = 'Không thể kết nối đến cơ sở dữ liệu';
    }
} catch (Exception $e) {
    $dbError = $e->getMessage();
}

// Kiểm tra quyền truy cập file
$filePermissions = [
    'add_student.php' => is_writable(__DIR__ . '/add_student.php'),
    'check_student.php' => is_writable(__DIR__ . '/check_student.php'),
    'api_dir' => is_writable(__DIR__)
];

// Kiểm tra PHP Info
$phpInfo = [
    'version' => phpversion(),
    'post_max_size' => ini_get('post_max_size'),
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'max_execution_time' => ini_get('max_execution_time'),
];

// Trả về trạng thái
echo json_encode([
    'status' => 'ok',
    'time' => date('Y-m-d H:i:s'),
    'db_status' => $dbStatus,
    'db_error' => $dbError,
    'file_permissions' => $filePermissions,
    'php_info' => $phpInfo
]);
