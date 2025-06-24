<?php
//xử lý login
if (isset($_SESSION['sv_login'])) {
    header('location:index.php');
}
if(isset($_POST['dangnhap'])){
    $tk=$_POST['masv'];
    $mk=$_POST['pass'];
    $sql="select * from sinhvien where MaSV=$tk and MatKhau='$mk'";
    $rs=mysqli_query($conn,$sql);
    $dem=mysqli_num_rows($rs);
    if($dem==0){
        echo '<script>alert("Sai tài khoản hoặc mật khẩu ! Hãy nhập lại .")</script>';
    }else{
        $row=mysqli_fetch_array($rs);
        $_SESSION['sv_login'] = $row;
        header('location:index.php');
    }
}
?>
<div class="cart">
    <div class="col-sm-6 mx-auto">
        <div class="card shadow-lg my-5">
            <div class="card-body">
                <h5 class="card-title text-center mb-4" style="font-weight: bold;">Đăng nhập</h5>
                <form class="form-signin" action="" method="POST">
                    <div class="form-group">
                        <label for="inputEmail">Mã sinh viên</label>
                        <input type="text" id="inputEmail" class="form-control form-control-lg" placeholder="Mã sinh viên" name="masv" required autofocus>
                    </div>
                    <div class="form-group mt-3">
                        <label for="inputPassword">Mật khẩu</label>
                        <input type="password" id="inputPassword" class="form-control form-control-lg" placeholder="Mật khẩu" name="pass" required>
                    </div>
                    <div class="form-group text-center mt-4">
                        <input class="btn btn-danger btn-lg btn-block text-uppercase" name="dangnhap" type="submit" value="Đăng nhập">
                    </div>
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</div>
