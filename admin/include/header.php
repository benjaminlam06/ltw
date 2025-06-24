<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="/KTX-SPKT/font/Font Awesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="template/cssfont.css" rel="stylesheet">
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body >
<div id="content-wrapper" class="d-flex flex-column">
    <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <h3 > </h3>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span style="font-size: 16px; color: #000; font-weight: bold;" class="mr-2 d-none d-lg-inline small"><?php if(isset($_SESSION['nv_admin'])){ $nv=$_SESSION['nv_admin'];
                                echo $nv['HoTen'];} ?>
                        </span>
                        <i class="fas fa-users-cog font" style="font-size: 25px;color: #333"></i>
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="logout.php" >
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Đăng xuất
                        </a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
</body>
</html>
