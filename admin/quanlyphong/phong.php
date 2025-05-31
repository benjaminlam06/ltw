<?php
$sql = "SELECT * FROM Phong";
$rs = mysqli_query($conn, $sql);
?>
<table class="table table-hover text-center">
    <thead class="badge-info">
        <tr>
            <th>Mã Phòng</th>
            <th>Mã Khu</th>
            <th>Số Người Tối Đa</th>
            <th>Số Người Hiện Tại</th>
            <th>Giá</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
    <?php while ($row = mysqli_fetch_array($rs)) { ?>
        <tr>
            <td><?php echo $row['MaPhong']; ?></td>
            <td><?php echo $row['MaKhu']; ?></td>
            <td><?php echo $row['SoNguoiToiDa']; ?></td>
            <td><?php echo $row['SoNguoiHienTai']; ?></td>
            <td><?php echo number_format($row['Gia']); ?></td>
            <td>
                <a href="index.php?action=quanlyphong&view=sua&map=<?php echo $row['MaPhong']; ?>" class="btn btn-primary btn-sm">Cập nhật</a>
                <a href="javascript:void(0)" onclick="confirmDelete('<?php echo $row['MaPhong']; ?>')" class="btn btn-danger btn-sm">Xóa</a>
            </td>
        </tr>
    <?php } ?>
    </tbody>
</table>

<!-- Thêm script ở cuối file, trước tag đóng body -->
<script>
function confirmDelete(maphong) {
    if(confirm('Bạn có chắc chắn muốn xóa phòng này không?')) {
        window.location.href = 'quanlyphong/xoa.php?map=' + maphong;
    }
}
</script>