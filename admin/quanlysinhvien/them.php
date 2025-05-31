<h6 class="text-center">Thêm Sinh viên Mới</h6>
<!-- Thêm div thông báo -->
<div id="notification" class="alert" style="display: none;"></div>

<table class="table table-hover text-center ">
    <form id="studentForm" method="post">
        <thead>
        <tr>
            <th>Mã SV</th><th>Họ Tên</th><th>Ngày Sinh</th><th>Giới  Tính</th><th>Địa Chỉ</th><th>SĐT</th><th>Mật Khẩu</th><th>#</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input class="form-control form-control-sm" type="text" name="masv" id="masv" onblur="checkStudentId(this.value)" required>
                <small id="masv-error" class="text-danger"></small>
            </td>
            <td><input class="form-control form-control-sm" type="text" name="ten" required></td>
            <td><input class="form-control form-control-sm" type="date" name="ns" required></td>
            <td><input class="form-control form-control-sm" type="text" name="gt" required></td>
            <td><input class="form-control form-control-sm" type="text" name="dc" required></td>
            <td><input class="form-control form-control-sm" type="text" name="sdt" required></td>
            <td><input class="form-control form-control-sm" type="text" name="mk" required></td>
            <td>
                <button class="btn-sm btn-success btn" type="button" onclick="addNewStudentSimple()" id="submitBtn">Thêm</button>
            </td>
        </tr>
        </tbody>
    </form>
</table>

<!-- Email field row -->
<div class="row mb-2 mt-1">
    <div class="col-md-4 offset-md-4">
        <div class="form-group">
            <label for="email">Email sinh viên</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Nhập địa chỉ email" form="studentForm">
        </div>
    </div>
</div>

<!-- Form tìm kiếm -->
<div class="row mb-3">
    <div class="col-md-6 offset-md-3">
        <div class="input-group">
            <input type="text" id="searchKeyword" class="form-control" placeholder="Nhập mã hoặc tên sinh viên cần tìm...">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" onclick="searchStudent()">Tìm</button>
            </div>
        </div>
    </div>
</div>

<!-- Bảng hiển thị kết quả - Ban đầu ẩn đi -->
<div id="searchResultContainer" style="display: none;">
    <h6 class="text-center">Kết quả tìm kiếm</h6>
    <table class="table table-hover text-center" id="resultTable">
        <thead>
            <tr>
                <th>Mã SV</th><th>Họ Tên</th><th>Ngày Sinh</th><th>Giới Tính</th><th>Địa Chỉ</th><th>SĐT</th><th>Email</th><th colspan="2">#</th>
            </tr>
        </thead>
        <tbody id="resultTableBody">
        </tbody>
    </table>
</div>

<script>
function searchStudent() {
    const keyword = document.getElementById('searchKeyword').value.trim();
    if (!keyword) {
        alert('Vui lòng nhập từ khóa tìm kiếm');
        return;
    }

    const resultContainer = document.getElementById('searchResultContainer');
    
    fetch(`quanlysinhvien/tim.php?keyword=${encodeURIComponent(keyword)}`)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('resultTableBody');
            
            // Hiển thị container kết quả
            resultContainer.style.display = 'block';
            
            if (data.status === 'success') {
                tableBody.innerHTML = '';
                data.data.forEach(student => {
                    tableBody.innerHTML += `
                        <tr>
                            <form action="quanlysinhvien/xuly.php" method="get" accept-charset="utf-8">
                                <td>${student.MaSV}<input type="hidden" name="masv" value="${student.MaSV}"></td>
                                <td><input class="form-control form-control-sm" type="text" name="ten" value="${student.HoTen}"></td>
                                <td><input class="form-control form-control-sm" type="date" name="ns" value="${student.NgaySinh}"></td>
                                <td><input class="form-control form-control-sm" type="text" name="gt" value="${student.GioiTinh}"></td>
                                <td><input class="form-control form-control-sm" type="text" name="dc" value="${student.DiaChi}"></td>
                                <td><input class="form-control form-control-sm" type="text" name="sdt" value="${student.SDT}"></td>
                                <td><input class="form-control form-control-sm" type="email" name="email" value="${student.Email || ''}"></td>
                                <td><input class="btn-sm btn-success btn" type="submit" name="action" value="Cập nhật"></td>
                                <td>
                                    <a href="quanlysinhvien/xoa.php?masv=${student.MaSV}" 
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">
                                        Xóa
                                    </a>
                                </td>
                            </form>
                        </tr>
                    `;
                });
            } else {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="8" class="text-center">${data.message}</td>
                    </tr>
                `;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi tìm kiếm');
            resultContainer.style.display = 'none';
        });
}

// Thêm sự kiện Enter cho ô tìm kiếm
document.getElementById('searchKeyword').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        e.preventDefault();
        searchStudent();
    }
});

// Thêm sự kiện reset form tìm kiếm
document.getElementById('searchKeyword').addEventListener('input', function(e) {
    if (!this.value.trim()) {
        document.getElementById('searchResultContainer').style.display = 'none';
    }
});

// Liên kết form và field email khi submit
document.getElementById('studentForm').addEventListener('submit', function(e) {
    const emailField = document.getElementById('email');
    if (emailField && emailField.value) {
        // Email field is already part of the form, no action needed
    } else if (emailField) {
        // Ensure the email field is submitted with the form
        const hiddenEmail = document.createElement('input');
        hiddenEmail.type = 'hidden';
        hiddenEmail.name = 'email';
        hiddenEmail.value = emailField.value || '';
        this.appendChild(hiddenEmail);
    }
});

// Kiểm tra mã sinh viên khi nhập
let studentIdTimer;
function checkStudentId(masv) {
    clearTimeout(studentIdTimer);

    // Đợi người dùng ngừng gõ 500ms
    studentIdTimer = setTimeout(() => {
        if (!masv) {
            document.getElementById('masv-error').textContent = '';
            return;
        }

        // Hiển thị loading
        document.getElementById('masv-error').textContent = 'Đang kiểm tra...';

        console.log('Kiểm tra mã sinh viên:', masv);

        // Sử dụng đường dẫn đơn giản, bắt đầu từ thư mục gốc trang web
        fetch(`quanlysinhvien/check_masv.php?masv=${encodeURIComponent(masv)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Server responded with status: ' + response.status);
            }
            return response.json();
        })
        .then(data => {
            console.log('Kết quả kiểm tra:', data);
            const errorElement = document.getElementById('masv-error');
            if (data.exists) {
                errorElement.textContent = data.message;
                errorElement.className = 'text-danger';
                document.getElementById('masv').setCustomValidity('Mã sinh viên đã tồn tại');
            } else {
                errorElement.textContent = data.message;
                errorElement.className = 'text-success';
                document.getElementById('masv').setCustomValidity('');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('masv-error').textContent = 'Lỗi kiểm tra mã sinh viên: ' + error.message;
            document.getElementById('masv-error').className = 'text-danger';
        });
    }, 500);
}

// Hàm thêm sinh viên mới đơn giản hơn
function addNewStudentSimple() {
    // Lấy form
    const form = document.getElementById('studentForm');

    // Kiểm tra validation
    if (!form.checkValidity()) {
        // Kích hoạt báo lỗi HTML5 trên form
        form.reportValidity();
        return false;
    }

    // Kiểm tra mã sinh viên hợp lệ
    const masvInput = document.getElementById('masv');
    if (masvInput.validity.customError) {
        showNotification('error', 'Mã sinh viên đã tồn tại');
        return false;
    }

    // Lấy dữ liệu từ form
    const masv = document.querySelector('input[name="masv"]').value;
    const ten = document.querySelector('input[name="ten"]').value;
    const ns = document.querySelector('input[name="ns"]').value;
    const gt = document.querySelector('input[name="gt"]').value;
    const dc = document.querySelector('input[name="dc"]').value;
    const sdt = document.querySelector('input[name="sdt"]').value;
    const mk = document.querySelector('input[name="mk"]').value;
    const email = document.getElementById('email') ? document.getElementById('email').value : '';

    // Tạo object chứa dữ liệu
    const studentData = { masv, ten, ns, gt, dc, sdt, mk, email, action: 'Thêm' };

    console.log('Dữ liệu sinh viên:', studentData);

    // Hiển thị loading
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    submitBtn.disabled = true;
    submitBtn.innerHTML = 'Đang xử lý...';

    // Hiển thị thông báo đang xử lý
    showNotification('info', 'Đang thêm sinh viên mới...');

    // Sử dụng XMLHttpRequest thay vì fetch để tương thích tốt hơn
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'quanlysinhvien/xuly_ajax.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        if (xhr.status === 200) {
            try {
                console.log('Phản hồi từ server:', xhr.responseText);
                const response = JSON.parse(xhr.responseText);

                if (response.success) {
                    // Hiển thị thông báo thành công
                    showNotification('success', response.message || 'Thêm sinh viên thành công');

                    // Reset form
                    form.reset();
                    document.getElementById('masv-error').textContent = '';

                    // Nếu thành công và muốn reload trang
                    setTimeout(() => {
                        window.location.href = 'index.php?action=sinhvien&view=all&thongbao=them';
                    }, 1500);
                } else {
                    // Hiển thị lỗi
                    showNotification('error', response.message || 'Lỗi khi thêm sinh viên');
                }
            } catch (e) {
                console.error('Lỗi khi xử lý phản hồi:', e);
                showNotification('error', 'Lỗi khi xử lý phản hồi từ server');
            }
        } else {
            console.error('Lỗi HTTP:', xhr.status);
            showNotification('error', 'Lỗi kết nối đến server: ' + xhr.status);
        }

        // Khôi phục nút submit
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    };

    xhr.onerror = function() {
        console.error('Lỗi kết nối');
        showNotification('error', 'Không thể kết nối đến server');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    };

    // Chuyển đổi object thành chuỗi query string
    const formData = Object.keys(studentData)
        .map(key => encodeURIComponent(key) + '=' + encodeURIComponent(studentData[key]))
        .join('&');

    console.log('Dữ liệu gửi đi:', formData);

    // Gửi request
    xhr.send(formData);

    return false;
}

// Hàm hiển thị thông báo
function showNotification(type, message) {
    const notification = document.getElementById('notification');
    notification.style.display = 'block';

    if (type === 'success') {
        notification.className = 'alert alert-success';
    } else {
        notification.className = 'alert alert-danger';
    }

    notification.textContent = message;

    // Tự động ẩn thông báo sau 5 giây
    setTimeout(() => {
        notification.style.display = 'none';
    }, 5000);
}

// Thêm sinh viên vào bảng hiển thị (nếu có)
function addStudentToTable(student) {
    // Kiểm tra nếu có bảng hiển thị sinh viên thì thêm vào
    const tableBody = document.querySelector('table.table tbody');
    if (tableBody && tableBody !== document.querySelector('#studentForm tbody')) {
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>${student.MaSV}</td>
            <td>${student.HoTen}</td>
            <td>${student.NgaySinh}</td>
            <td>${student.GioiTinh}</td>
            <td>${student.DiaChi}</td>
            <td>${student.SDT}</td>
            <td>${student.Email || ''}</td>
            <td>
                <a href="index.php?action=sinhvien&view=sua&masv=${student.MaSV}" class="btn btn-primary btn-sm">Sửa</a>
            </td>
            <td>
                <a href="quanlysinhvien/xoa.php?masv=${student.MaSV}" 
                   class="btn btn-danger btn-sm"
                   onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên này không?')">
                    Xóa
                </a>
            </td>
        `;
        tableBody.appendChild(newRow);
    }
}
</script>