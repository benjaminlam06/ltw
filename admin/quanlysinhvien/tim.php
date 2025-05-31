<?php
include_once('../../config/database.php');

if(isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($conn, $_GET['keyword']);

    //
    $sql = "SELECT * FROM sinhvien 
            WHERE MaSV LIKE '%$keyword%' 
            OR HoTen LIKE '%$keyword%'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        $data = array();
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Không tìm thấy sinh viên'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Vui lòng nhập từ khóa tìm kiếm'
    ]);
}
?>