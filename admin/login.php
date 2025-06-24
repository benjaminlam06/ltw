<!DOCTYPE html>
<html lang="vi">
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
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập - Quản lý KTX</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8f9fa;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 100%;
            max-width: 400px;
        }
        .login-header {
            text-align: center;
            color: #932120;
            margin-bottom: 1.5rem;
        }
        .form-control {
            width: 100%;
            border-radius: 5px;
            padding: 0.75rem 1rem;
            border: 1px solid #ddd;
            margin-bottom: 1rem;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #932120;
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(147, 33, 32, 0.25);
        }
        .btn-login {
            background-color: #932120;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 0.75rem;
            width: 100%;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .btn-login:hover {
            background-color: #7a1c1b;
        }
        .login-footer {
            text-align: center;
            margin-top: 1rem;
            font-size: 0.9rem;
        }
        .login-footer a {
            color: #932120;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
        /* Optional icon container */
        .input-group {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-group span.icon {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #666;
        }
        .input-group input {
            padding-left: 2.5rem; /* make space for icon */
        }
    </style>
</head>
<body>
<div class="login-container">
    <div class="login-card">
        <div class="login-header">
            <h2>Đăng Nhập</h2>
            <p>Quản túc</p>
        </div>
        <form action="" method="post" id="login_form">
            <div class="input-group">
                <label for="01">Mã nhân viên</label>
                <input name="email" id = "02" type="text" class="form-control" placeholder="Mã Nhân viên" required autofocus>
            </div>

            <div class="input-group">
                <label for="01">Mật khẩu</label>
                <input name="pass" id = "01" type="password" class="form-control" placeholder="Mật khẩu" required>
            </div>

            <button type="submit" name="login" class="btn btn-login">Đăng nhập</button>

            <div class="login-footer">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký</a></p>
            </div>
        </form>
    </div>
</div>
</body>
</html>