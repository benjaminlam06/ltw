<h6 class="text-center">Thêm Sinh viên Mới</h6>
<table class="table table-hover text-center ">
    <form action="quanlysinhvien/xuly.php" method="get" accept-charset="utf-8">
        <thead>
        <tr>
            <th>Mã SV</th><th>Họ Tên</th><th>Ngày Sinh</th><th>Giới  Tính</th><th>Địa Chỉ</th><th>SĐT</th><th>Mật Khẩu</th><th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><input class="form-control form-control-sm" type="text"  name="masv" ></td>
            <td><input  class="form-control form-control-sm" type="text" name="ten" ></td>
            <td><input  class="form-control form-control-sm" type="date" name="ns" ></td>
            <td><input  class="form-control form-control-sm" type="text" name="gt" ></td>
            <td><input  class="form-control form-control-sm" type="text" name="dc" ></td>
            <td><input  class="form-control form-control-sm" type="text" name="sdt" ></td>
            <td><input  class="form-control form-control-sm" type="text" name="mk" ></td>
            <td><input  class="btn-sm btn-success btn" type="submit" name="action" value="Thêm"></td>
        </tr>
        </tbody>
</table>
</form>	<br><hr>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const masvInput = document.querySelector('input[name="masv"]');
        const submitBtn = document.querySelector('input[type="submit"][name="action"]');
        const warningSpan = document.createElement('span');

        warningSpan.style.color = 'red';
        warningSpan.style.fontSize = '0.9rem';
        masvInput.parentNode.appendChild(warningSpan);

        masvInput.addEventListener('blur', function () {
            const masv = masvInput.value.trim();
            if (masv !== '') {
                fetch('quanlysinhvien/check_masv.php?masv=' + encodeURIComponent(masv))
                    .then(response => response.text())
                    .then(data => {
                        if (data === 'exist') {
                            warningSpan.textContent = 'Mã sinh viên đã tồn tại!';
                            submitBtn.disabled = true;
                        } else {
                            warningSpan.textContent = '';
                            submitBtn.disabled = false;
                        }
                    })
                    .catch(err => {
                        console.error('Lỗi khi kiểm tra mã SV:', err);
                        warningSpan.textContent = '';
                    });
            } else {
                warningSpan.textContent = '';
                submitBtn.disabled = false;
            }
        });
    });
</script>
