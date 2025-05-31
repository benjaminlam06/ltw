<?php
$sql="select * from Khu ";
$rs=mysqli_query($conn,$sql);

?>
<table class="table table-hover text-center " style="font-size: 90%">
    <thead class="badge-info">
    <tr>
        <th>Mã Khu</th><th>Tên Khu</th><th>Giới Tính</th><th colspan ="3" class="badge-danger"></th>
    </tr>
    </thead>
    <?php

    while ($row=mysqli_fetch_array($rs)) { ?>
        <tbody>
<tr>
    <td><?php echo $row['MaKhu'] ?></td>
    <td><?php echo $row['TenKhu'] ?></td>
    <td><?php echo $row['Sex'] ?></td>
    <td>
        <a href="index.php?action=khu&view=sua&map=<?php echo $row['MaKhu']?>" class="btn btn-primary btn-sm">Cập Nhật</a>
        <a href="javascript:void(0);" onclick="confirmDelete('<?php echo $row['MaKhu'] ?>')" class="btn btn-danger btn-sm">Xóa</a>
    </td>
</tr>
        </tbody>
    <?php }?>
</table>
<hr class="badge-danger">
<?php


?>
<!-- Thêm đoạn JavaScript này vào cuối file -->
<script>
function confirmDelete(makhu) {
    if(confirm('Bạn có chắc chắn muốn xóa khu này?\nMọi thông tin về phòng và sinh viên trong khu này sẽ bị xóa!')) {
        window.location.href = 'quanlykhu/xoa.php?map=' + makhu;
    }
}
</script>