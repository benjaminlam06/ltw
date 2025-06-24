<?php
    if(isset($_GET['action'])){
        $action = $_GET['action'];
        switch ($action) {
            case 'login':
                include_once('view/login.php');
                break;
            case 'capnhapthongtin':
                include_once('view/capnhatthongtin.php');
                break;
            case 'dkphong':
                include_once('view/dangkyphong.php');
                break;
            case 'chuyenphong':
                include_once('view/dangkychuyenphong.php');
                break;
            case 'traphong':
                include_once('view/traphong.php');
                break;
            case 'logout':
                include_once('view/logout.php');
                break;
            default:
                include_once('view/main.php');
                break;
        }
    }
	if(isset($_GET['tb'])){
			$tb = $_GET['tb'];
			switch ($tb) {
				case 'ok':
				     echo '<script>alert("success!!!")</script>';
					break;
				case 'loi':
				     echo '<script>alert("Lỗi!!!")</script>';
					break;	
				case 'ok1':
				     echo '<script>alert("Đăng ký thành công. Chờ duyệt")</script>';
					break;
				case 'ok2':
				     echo '<script>alert("Đăng ký trả phòng thành công. Chờ duyệt...")</script>';
					break;	
				case 'loi1':
				     echo '<script>alert("Vui lòng trả phòng đang ở trước khi đăng ký...")</script>';
					break;
				case 'loi2':
				     echo '<script>alert("Lỗi!!!")</script>';
					break;
				case 'loi3':
						$sn=$_GET['sn'];
				     echo '<script>alert("Phòng ('.$sn.' người) đã hết. Vui lòng chọn phòng khác !!!")</script>';
					break;									
				default:
				 
				break;
		}
	}
	else
	{
		include_once('view/main.php');
	}
?>