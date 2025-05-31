
<div class="cart">
    <div class="col-sm-9  mx-auto">
        <div class="card card-signin my-5">
            <div class="card-body">
                <h5 class="card-title text-center">Sign In</h5>
                <form class="form-signin" action="" method="POST">
                    <div class="form-label-group">
                        <input type="text" id="inputEmail" class="form-control" placeholder="Mã sinh viên" name="masv" required autofocus>
                    </div>
                    <br>
                    <div class="form-label-group">
                        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="pass" required>
                    </div><br>
                    <input class="btn btn-lg btn-danger btn-block text-uppercase" name="dangnhap" type="submit" value=" Sign in">
                    <hr class="my-4">
                </form>
            </div>
        </div>
    </div>
</div>
<?php
//xử lý login
#code...
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
        $_SESSION['sv_login']=$row;

        header('location:index.php');
    }
}
?>