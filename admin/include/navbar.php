<div class="col-2" style="margin-left: -25px; margin-top: -20px;margin-right: 10px;">
    <!-- Thêm style cho icon collapse và màu đỏ đậm -->
    <style>
        #accordionSidebar {
            background-color: #c9000a !important;
            background-image: none !important;
        }

        /* Style cho icon collapse */
        .nav-link[data-toggle="collapse"]::after {
            content: '\f105'; /* Icon mũi tên từ Font Awesome */
            font-family: 'Font Awesome 5 Free';
            font-weight: 900;
            float: right;
            color: rgba(255,255,255,0.7);
            margin-left: 10px;
            transition: all 0.2s ease;
        }

        /* Xoay icon khi menu được mở */
        .nav-link[aria-expanded="true"]::after {
            transform: rotate(90deg);
            color: #fff;
        }

        /* Style cho các menu items */
        .nav-item .nav-link {
            padding: 0.7rem 1rem;
            display: flex;
            align-items: center;
        }

        .nav-item .nav-link:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Style cho tiêu đề bảng */
        .badge-info {
            background-color: #000080 !important;
            color: white !important;
        }

        /* Style cho nút trong bảng */
        .table .btn-priman {
            background-color: #2E5A88;
            border-color: #2E5A88;
        }

        .table .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
        }
    </style>

    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
            <div class="sidebar-brand-icon">
                <i class="fas fa-building"></i>
            </div>
            <div class="sidebar-brand-text mx-3">Ban Quản Túc PTIT</div>
        </a>
        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="index.php">
                <i class="fas fa-fw fa-home"></i>
                <span>Trang chủ</span></a>
        </li>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
        </div>
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sanpham" aria-expanded="true" aria-controls="sanpham">
                <i class="fas fa-fw fa-cog"></i>
                <span>Quản Lý Đăng Ký Phòng</span>
            </a>
            <div id="sanpham" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <!-- <h6 class="collapse-header">Quản Lý Sản Phẩm</h6>-->
                    <a class="collapse-item" href="index.php?action=quanlydangkyphong&view=quanlydangkyphong">Xử Lý Đăng Ký</a>
                    <a class="collapse-item" href="index.php?action=quanlydangkyphong&view=danhsachall">Danh Sách Đã Xử Lý</a>

                </div>

            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#danhmuc" aria-expanded="true" aria-controls="danhmuc">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý Chuyển Phòng</span>
            </a>
            <div id="danhmuc" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="index.php?action=quanlychuyenphong&view=quanlychuyenphong">Xử Lý Đ/K Chuyển Phòng</a>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#danhmuc1" aria-expanded="true" aria-controls="danhmuc1">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý Trả Phòng</span>
            </a>
            <div id="danhmuc1" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="index.php?action=quanlytraphong&view=quanlytraphong">Xử Lý Đ/K Trả Phòng</a>

                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#hoadon" aria-expanded="true" aria-controls="hoadon">
                <i class="fas fa-yen-sign"></i>
                <span>Quản Lý Tiền Điện Nước</span>
            </a>
            <div id="hoadon" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="index.php?action=quanlydiennuoc&view=quanlydiennuoc">Thêm tiền điện nước</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#phong" aria-expanded="true" aria-controls="phong">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý  Phòng</span>
            </a>
            <div id="phong" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="index.php?action=quanlyphong&view=quanlyphong">Phòng</a>

                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#khu" aria-expanded="true" aria-controls="khu">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý  Khu</span>
            </a>
            <div id="khu" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item" href="index.php?action=khu&view=khu">Khu</a>

                </div>
            </div>
        </li>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nv" aria-expanded="true" aria-controls="nv">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý  Nhân Viên</span>
            </a>
            <div id="nv" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="index.php?action=nhanvien&view=all">Tất cả nhân viên</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sv" aria-expanded="true" aria-controls="sv">
                <i class="fas fa-poll-h"></i>
                <span>Quản Lý  Sinh Viên</span>
            </a>
            <div id="sv" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="index.php?action=sinhvien&view=all">Tất cả sinh viên</a>
                </div>
            </div>
        </li>
    </ul>

    <!-- Script để xử lý icon collapse -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Đánh dấu menu đang active dựa vào URL hiện tại
        const currentUrl = window.location.href;
        const menuItems = document.querySelectorAll('.collapse-item');

        menuItems.forEach(function(item) {
            if(currentUrl.includes(item.getAttribute('href'))) {
                // Highlight menu item
                item.classList.add('active');
                item.style.fontWeight = 'bold';
                item.style.color = '#c9000a';

                // Mở rộng parent collapse
                const parent = item.closest('.collapse');
                if(parent) {
                    parent.classList.add('show');
                    const trigger = document.querySelector('[data-target="#' + parent.id + '"]');
                    if(trigger) {
                        trigger.setAttribute('aria-expanded', 'true');
                        trigger.classList.remove('collapsed');
                    }
                }
            }
        });
    });
    </script>
</div>