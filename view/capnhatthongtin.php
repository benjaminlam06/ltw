  <?php 
    if (isset($_SESSION['sv_login'])) {
        $sv=$_SESSION['sv_login'];
    $masv=$sv['MaSV'];
    $sql="select * from sinhvien where MaSV=$masv";
    $rs=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($rs);
  ?>
    <div class="cart">
      <div class="col-sm-10  mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Cập nhật thông tin cá nhân</h5>
            <form class="form-signin" action="xuly/capnhatthongtin.php" method="POST">
              <div class="form-label-group">
                <span>Mã sinh viên </span>
                <input type="text" id="inputText" class="form-control"  value="<?php echo $row['MaSV'] ?>"  disabled >
                <input hidden id="inputText" class="form-control" name="masv" value="<?php echo $row['MaSV'] ?>"  >
              </div>
              <hr>
              <span>Họ và tên </span>
              <div class="form-label-group">
              <input type="text" id="inputText" class="form-control" placeholder="Họ và Tên" value="<?php echo $row['HoTen'] ?>" disabled required >
              </div>
              <hr>
              <span>Giới Tính </span>
              <div class="form-label-group">
              <input type="text" id="inputText" class="form-control" placeholder="Họ và Tên" value="<?php echo $row['GioiTinh']?>" disabled required >
              </div>
              <hr>
              <span>Ngày sinh </span>
              <div class="form-label-group">
                <input type="date" name="ns" max="3000-12-31" min="1000-01-01" class="form-control" value="<?php echo $row['NgaySinh']?>">
              </div>
              <hr>
              <span>Quê quán </span>
              <div class="form-label-group">
                <input type="text" id="inputText" class="form-control" name="dc" value="<?php echo $row['DiaChi']?>" required  >
              </div>
              <hr>
              <span>Số điện thoại </span>
              <div class="form-label-group">
                <input type="text" id="inputText" class="form-control" name="sdt" value="<?php echo $row['SDT']?>" required  >
              </div>
              <hr>
                <span>Email </span>
                <div class="form-label-group">
                <input type="email" id="inputText" class="form-control" name="email" value="<?php echo $row['Email']?>" required  >
                </div>
                <hr>
              <span>Password </span>
              <div class="form-label-group">
                <input type="password"  class="form-control" name="pass" placeholder="Password" >
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
              </div>
                <button class="btn btn-lg btn-danger btn-block text-uppercase" name ="sv_capnhattt" type="submit">Cập Nhật</button>
              <hr class="my-4">
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
    }
   else{
    header('location:index.php?action=login');
   }
    ?>


