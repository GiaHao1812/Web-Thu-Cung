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
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Thông Tin Đơn Hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Sửa thông tin đơn hàng: <?= $donHang['ma_don_hang'] ?></h3>
                        </div>


                        <form action="<?= BASE_URL_ADMIN . '?act=sua-don-hang' ?>" method="POST">
                            <input type="text" name="don_hang_id" value="<?= $donHang['id'] ?>" hidden>
                            <div class="card-body">
                                <hr>
                                <div class="form-group">
                                    <label for="inputStatus">Trang Thái Đơn Hàng</label>
                                    <select id="inputStatus" name="trang_thai_id" class="form-control custom-select">

                                        <?php foreach ($listTrangThaiDonHang as $trangThai): ?>
                                            <option <?php
                                                    if (
                                                        $donHang['trang_thai_id'] > $trangThai['id']
                                                        || $donHang['trang_thai_id'] == 9
                                                        || $donHang['trang_thai_id'] == 10
                                                        || $donHang['trang_thai_id'] == 11

                                                    ) {
                                                        echo 'disabled';
                                                    }


                                                    ?>
                                                <?= $trangThai['id'] == $donHang['trang_thai_id'] ? 'selected' : '' ?>
                                                value="<?= $trangThai['id'] ?>"><?= $trangThai['ten_trang_thai'] ?></>
                                            <?php endforeach; ?>
                                    </select>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Footer  -->
<?php include './views/layout/footer.php'; ?>
<!-- End Footer  -->


</body>

</html>