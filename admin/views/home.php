<!-- Header  -->
<?php include './views/layout/header.php'; ?>
<!-- End Header  -->
<!-- Navbar -->
<?php include './views/layout/navbar.php'; ?>

<!-- /.navbar -->

<!-- Main Sidebar Container -->
<?php include './views/layout/sidebar.php'; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="content">
            <div class="container-fluid">
                <h1 class="ts-4">Trang Chủ</h1>
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!-- <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button> -->

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="chart-responsive">

                                            <div class="chart-container">
                                                <canvas id="myChart" width="400" height="200"></canvas>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Trạng Thái Đơn Hàng</th>
                                                    <th>Số Lượng Đơn Hàng</th>
                                                    <th>Ngày Đặt</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($donHangStats as $stat): ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($stat['ten_trang_thai']); ?></td>
                                                        <td><?php echo $stat['so_luong_don_hang']; ?></td>
                                                        <td><?php echo htmlspecialchars($stat['ngay_dat']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                    </div>

                                </div>

                            </div>

                            <!-- <div class="card-footer p-0">
                                <ul class="nav nav-pills flex-column">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            United States of America
                                            <span class="float-right text-danger">
                                                <i class="fas fa-arrow-down text-sm"></i>
                                                12%</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            India
                                            <span class="float-right text-success">
                                                <i class="fas fa-arrow-up text-sm"></i> 4%
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            China
                                            <span class="float-right text-warning">
                                                <i class="fas fa-arrow-left text-sm"></i> 0%
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div> -->
                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>
                            <div class="d-flex flex-row justify-content-end">
                                <span class="mr-2">
                                    <i class="fas fa-square text-primary"></i> This Week
                                </span>
                                <span>
                                    <i class="fas fa-square text-gray"></i> Last Week
                                </span>
                            </div>
                        </div>




                    </div>
                </div>

                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="card-title">Sản Phẩm </h3>
                        <div class="card-tools">
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="#" class="btn btn-tool btn-sm">
                                <i class="fas fa-bars"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-striped table-valign-middle">
                            <thead>
                                <tr>
                                    <th>Ảnh Sản Phẩm</th>
                                    <th> Tên Sản Phẩm</th>
                                    <th>Giá </th>
                                    <th>Giá Khuyến Mãi</th>
                                    <th>Danh Mục</th>
                                    <th>Trạng Thái</th>
                                    <th>Thông tin </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($listSanPham as $key => $sanpham): ?>
                                    <tr>
                                        <td><img src="<?= BASE_URL . $sanpham['hinh_anh'] ?>" style="width: 50px;" alt=""
                                                onerror="this.onerror=null; this.src='<?= BASE_URL ?>/uploads/ao.jpg'">
                                        </td>

                                        <td><?= $sanpham['ten_san_pham'] ?></td>

                                        <td><?= $sanpham['gia_san_pham'] ?></td>
                                        <td><?= $sanpham['gia_khuyen_mai'] ?></td>
                                        <td><?= $sanpham['ten_danh_muc'] ?></td>
                                        <td><?= $sanpham['trang_thai'] == 1 ? 'Còn bán' : 'DỪng bán'; ?></td>
                                        <td>
                                            <a class="btn btn-primary"
                                                href="<?= BASE_URL_ADMIN . '?act=chi-tiet-san-pham&id_san_pham=' . $sanpham['id'] ?>">
                                                <i class="nav-icon fas fa-solid fa-eye"></i>
                                            </a>

                                        </td>
                                    </tr>
                                <?php endforeach ?>

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

            <div class="col-lg-12">


                <!-- <div class="card">
                            <div class="card-header border-0">
                                <h3 class="card-title">Online Store Overview</h3>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-download"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-tool">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-success text-xl">
                                        <i class="ion ion-ios-refresh-empty"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-success"></i> 12%
                                        </span>
                                        <span class="text-muted">CONVERSION RATE</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center border-bottom mb-3">
                                    <p class="text-warning text-xl">
                                        <i class="ion ion-ios-cart-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-up text-warning"></i> 0.8%
                                        </span>
                                        <span class="text-muted">SALES RATE</span>
                                    </p>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-0">
                                    <p class="text-danger text-xl">
                                        <i class="ion ion-ios-people-outline"></i>
                                    </p>
                                    <p class="d-flex flex-column text-right">
                                        <span class="font-weight-bold">
                                            <i class="ion ion-android-arrow-down text-danger"></i> 1%
                                        </span>
                                        <span class="text-muted">REGISTRATION RATE</span>
                                    </p>
                                </div>

                            </div>
                        </div> -->
            </div>

        </div>

</div>

</div>

</div>
</section>

<!-- Main content -->

<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer  -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer  -->
<!-- Page specific script -->

<!-- Code injected by live-server -->

</body>

</html>