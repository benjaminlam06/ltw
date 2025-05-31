<?php
if (isset($_SESSION['sv_login'])) {
    $sv=$_SESSION['sv_login'];
    $masv=$sv['MaSV'];
    $sql2="select * from chitietdangky where MaSV=$masv and NgayTraPhong is null";
    $rs2=mysqli_query($conn,$sql2);
    $row2=mysqli_fetch_array($rs2);
//?>
    <div class="cart">
        <div class="col-sm-12  mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Trả Phòng KÝ TÚC XÁ</h5><hr>
                    <form class="col-md-12 m-auto" action="xuly/main.php?action=traphong" method="POST">
                        <div class="form-row">
                            <div class="form-group col-sm-4">
                                <label for="masv">Mã Sinh Viên</label>
                                <label class="form-control" > <?php echo $sv['MaSV']; ?></label>
                                <input hidden name="masv" value="<?php echo $sv['MaSV'] ?>">
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="hoten">Họ Tên</label>
                                <label class="form-control" ><?php echo $sv['HoTen']; ?> </label>
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="phong">Phòng Đang Ở</label>
                                <label class="form-control"><?php echo $row2['MaPhong']; ?></label>
                            </div>
                        </div>

                        <div class="form-group">

                            <label> <span style="color: red;font-size: 25px;"></span></label>
                        </div>
                        <hr>
                        <button type="submit" name="trap" class="btn btn-lg btn-danger btn-block text-uppercase ">Trả Phòng</button>
                    </form></div>
            </div>
        </div>
    </div>
<?php } ?>