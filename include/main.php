<div class="dashboard-container">
    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar sticky-top">
            <nav class="sidebar-nav">
                <div class="sidebar-header">
                    <h2 class="sidebar-title">
                        <i class="fas fa-user-graduate me-2"></i>
                        Sinh viên
                    </h2>
                </div>
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="index.php?action=login" class="nav-link">
                            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=capnhapthongtin" class="nav-link">
                            <i class="fas fa-user-edit me-2"></i>Cập nhập thông tin
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=dkphong" class="nav-link">
                            <i class="fas fa-home me-2"></i>Đăng ký phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=chuyenphong" class="nav-link">
                            <i class="fas fa-exchange-alt me-2"></i>Đăng ký chuyển phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=traphong" class="nav-link">
                            <i class="fas fa-door-open me-2"></i>Trả phòng
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="index.php?action=logout" class="nav-link">
                            <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <?php
        // empty beds cal function
        function getTotalEmptyBeds($MaKhu){
            global $conn;
        // Lấy tổng số giường trong khu
            $sql_total = "SELECT SUM(SoNguoiToiDa) as total_beds 
                  FROM phong 
                  WHERE MaKhu = '$MaKhu'";
            $result_total = mysqli_query($conn, $sql_total);
            if (!$result_total) {
                return "Lỗi truy vấn: " . mysqli_error($conn);
            }
            $row_total = mysqli_fetch_assoc($result_total);
            $total_beds = $row_total['total_beds'] ?: 0;
            // Đếm tổng số sinh viên hiện có trong các phòng của khu
            $sql_occupied = "SELECT SUM(SoNguoiHienTai) as occupied_beds 
                    FROM phong
                    WHERE MaKhu = '$MaKhu'";
            $result_occupied = mysqli_query($conn, $sql_occupied);
            if (!$result_occupied) {
                return "Lỗi truy vấn: " . mysqli_error($conn);
            }
            $row_occupied = mysqli_fetch_assoc($result_occupied);
            $occupied_beds = $row_occupied['occupied_beds'] ?: 0;
            // Tính số chỗ trống
            $empty_beds = $total_beds - $occupied_beds;
            return $empty_beds;
        }
        ?>
        <!-- Empty beds displaying -->
        <div class="col-md-10 col-lg-11 main-content">
            <div class="content-wrapper">
                <?php include_once('include/content.php'); ?>
            </div>
        </div>
        </div>
        <div class="container" style="padding-left: 230px;">
            <div class="row justify-content-center text-center">
                <div class="col-12">
                    <h4 class="mb-4">Các Ký Túc Xá</h4>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card mb-4">
                                <img src="photos/b1.jpg" class="card-img-top" alt="KTX A" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">KTX A</h5>
                                    <p class="card-text">Còn <strong><?php echo getTotalEmptyBeds('A'); ?></strong>  chỗ trống
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-4">
                                <img src="photos/b2.jpg" class="card-img-top" alt="KTX B" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">KTX B</h5>
                                    <p class="card-text">Còn <strong> <?php echo getTotalEmptyBeds('B'); ?></strong> chỗ trống
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="card mb-4">
                                <img src="photos/b5.jpg" class="card-img-top" alt="KTX C" style="height: 200px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title">KTX C</h5>
                                    <p class="card-text">Còn <strong><?php echo getTotalEmptyBeds('C'); ?></strong>  chỗ trống
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <style>
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: transform 0.2s;
            height: 100%;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .card-img-top {
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        .card-body {
            padding: 1.15rem;
        }
        .card-title {
            color: #932120;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        .card-text {
            color: #666;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .col-sm-4 {
                margin-bottom: 1rem;
            }
        }
    </style>
</div>
<style>
    .dashboard-container {
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    /* Sidebar Styles */
    .sidebar {
        background: #ffffff;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        height: 100vh;
        position: fixed;
        z-index: 1000;
    }
    .sidebar-header {
        background: #932120;
        padding: 20px;
        text-align: center;
    }
    .sidebar-title {
        color: #ffffff;
        font-size: 1.5rem;
        margin: 0;
        font-weight: 600;
        text-transform: uppercase;
    }
    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .nav-item {
        border-bottom: 1px solid rgba(0,0,0,0.05);
    }
    .nav-link {
        display: flex;
        align-items: center;
        padding: 15px 20px;
        color: #333333;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }
    .nav-link:hover,
    .nav-link.active {
        background-color: rgba(193, 0, 0, 0.5);
        color: #932120;
        border-left: 4px solid #932120;
    }
    .nav-link i {
        margin-right: 10px;
        width: 20px;
        text-align: center;
    }
    /* Main Content Styles */
    .main-content {
        margin-left: 16.66667%; /* col-md-2 width */
        padding: 30px;
        transition: all 0.3s ease;
    }
    .content-wrapper {
        background: #ffffff;
        border-radius: 8px;
        padding: 25px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .sidebar {
            position: static;
            height: auto;
            margin-bottom: 20px;
        }
        .main-content {
            margin-left: 0;
            padding: 15px;
        }
        .nav-link {
            padding: 12px 15px;
        }
    }
</style>
<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">