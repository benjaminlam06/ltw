<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/shoponi/view/bootstrap4/css/bootstrap.css">
    <script src="/shoponi/jquery/jquery.js"></script>
    <script src="/shoponi/view/bootstrap4/js/bootstrap.js"></script>
    <link href="/shoponi/view/font/Font Awesome/css/all.min.css" rel="stylesheet">
    <title>Đăng nhập - Quản lý KTX</title>
    <style>
        body {
            background: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        .login-header {
            color: #932120;
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .form-control {
            border-radius: 5px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
        }
        .form-control:focus {
            border-color: #932120;
            box-shadow: 0 0 0 0.2rem rgba(147, 33, 32, 0.25);
        }
        .btn-login {
            background-color: #932120;
            border: none;
            border-radius: 5px;
            color: white;
            padding: 0.75rem;
            width: 100%;
            font-weight: 500;
            margin-top: 1rem;
        }
        .btn-login:hover {
            background-color: #7a1c1b;
            color: white;
        }
        .login-footer {
            text-align: center;
            margin-top: 1rem;
        }
        .login-footer a {
            color: #932120;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
        .input-group-text {
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            color: #666;
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>Đăng Nhập</h2>
            <p class="text-muted">Hệ thống quản lý ký túc xá</p>
        </div>
        <form action="" method="post" id="login_form">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                </div>
                <input name="email" type="text" class="form-control" placeholder="Mã Nhân viên" required autofocus>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                </div>
                <input name="pass" type="password" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" name="login" class="btn btn-login">
                Đăng nhập
            </button>

            <div class="login-footer">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p>
            </div>
        </form>
    </div>
</div>

<?php
include_once('../config/database.php');
@session_start();
if (isset($_SESSION['nv_admin'])) {
    header('location:index.php');
}
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $matkhau = $_POST['pass'];
    $sql_dangnhap = "SELECT * FROM NhanVien WHERE MaNV ='$email' AND MatKhau='$matkhau'";
    $run_dangnhap = mysqli_query($conn,$sql_dangnhap);
    $dangnhap = mysqli_fetch_array($run_dangnhap);
    $count_dangnhap = mysqli_num_rows($run_dangnhap);
    if($count_dangnhap == 0){
        echo '<script>alert("Sai tài khoản hoặc mật khẩu ! Xin mời nhập lại.")</script>';
    } else {
        $_SESSION['nv_admin'] = $dangnhap;
        header('location:index.php');
    }
}
?>
</body>
</html>