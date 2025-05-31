<?php
$sql="select *from sinhvien";
$rs=mysqli_query($conn,$sql);
?>


<table class="table table-hover text-center ">
    <thead>
    <tr>
        <th>Mã SV</th><th>Họ Tên</th><th>Ngày Sinh</th><th>Giới Tính</th><th>Địa Chỉ</th><th>SĐT</th><th>Email</th><th colspan="2">#</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($row=mysqli_fetch_array($rs)) {?>
        <form action="quanlysinhvien/xuly.php" method="get" accept-charset="utf-8">
            <tr>
                <td><?php echo $row['MaSV'] ?></td><input hidden name="masv" value="<?php echo $row['MaSV'] ?>">
                <td><input class="form-control form-control-sm" type="text" name="ten" value="<?php echo $row['HoTen'] ?>"></td>
                <td><input  class="form-control form-control-sm" type="date" name="ns" value="<?php echo $row['NgaySinh'] ?>"></td>
                <td><input  class="form-control form-control-sm" type="text" name="gt" value="<?php echo $row['GioiTinh'] ?>"></td>
                <td><input  class="form-control form-control-sm" type="text" name="dc" value="<?php echo $row['DiaChi'] ?>"></td>
                <td><input  class="form-control form-control-sm" type="text" name="sdt" value="<?php echo $row['SDT'] ?>"></td>
                <td><input  class="form-control form-control-sm" type="email" name="email" value="<?php echo $row['Email'] ?>"></td>
                <td><input  class="btn-sm btn-success btn" type="submit" name="action" value="Cập nhật"></td>
                <td><a      href="quanlysinhvien/xoa.php?masv=<?php echo $row['MaSV']; ?>"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?');">Xóa
                </td>
            </tr>
        </form>


    <?php	}?>
    </tbody>
</table>