<div class="col-10">
    <?php
      if(isset($_GET['action'])){
          $action=$_GET['action'];
          switch ($action) {
                    case 'logout':  
                        header('location:logout.php');
                    case 'quanlydangkyphong':
                        include('quanlydangkyphong/main.php');
                        break;
                    case 'quanlychuyenphong':
                        include('quanlychuyenphong/main.php');
                        break;  
                    case 'quanlydiennuoc':
                        include('quanlydiennuoc/main.php');
                        break;
                    case 'quanlyphong':
                        include('quanlyphong/main.php');
                        break; 
                     case 'quanlytraphong':
                        include('quanlytraphong/main.php');
                        break;  
                    case 'khu':
                        include('quanlykhu/main.php');
                        break;
                    case 'nhanvien':
                        include('quanlynhanvien/main.php');
                        break;
                    case 'sinhvien':
                        include('quanlysinhvien/main.php');
                        break;                           
                  
                    default:
                         
                        break;
                }
      }
      else {
          include_once('a.php');
      }
    ?>
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
    <div class="container" style="padding-left: 60px;">
        <div class="row pr-5 text-center">
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
  </div>
