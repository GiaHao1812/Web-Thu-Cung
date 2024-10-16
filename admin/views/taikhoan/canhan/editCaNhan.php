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
                    <h1>Quản Lý Tài Khoản Khách Hàng</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->

                <div class="col-md-3">
                    <div class="text-center">
                        <img src="<?= BASE_URL . $thongTin['anh_dai_dien']; ?>" class="avatar img-circle"
                            alt="<?= $thongTin['ho_ten'] ?>" style="width: 180px;"
                            onerror="this.onerror=null; this.src='<?= BASE_URL ?>/uploads/149071.png'">
                        <h6 class="mt-2">Họ Tên: <?= $thongTin['ho_ten'] ?></h6>
                        <h6 class="mt-2">Chức Vụ: <?= $thongTin['chuc_vu_id'] ?></h6>
                    </div>
                </div>

                <!-- edit form column -->

                <div class="col-md-9 personal-info">
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-thong-tin-ca-nhan-quan-tri' ?>" method="POST">
                        <hr>
                        <h3>Thông Tin Cá Nhân</h3>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Họ Tên:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="<?= $thongTin['ho_ten'] ?>" name="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label">Email:</label>
                            <div class="col-lg-12">
                                <input class="form-control" type="text" value="<?= $thongTin['email'] ?>">
                            </div>
                        </div>
                    </form>
                    <hr>
                    <h3>Đổi Mật Khẩu</h3>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-info alert-dismissable">
                            <a class="panel-close close" data-dismiss="alert">×</a>
                            <i class="fa fa-coffee"></i>
                            <?= $_SESSION['success'] ?>
                        </div>
                    <?php } ?>
                    <form action="<?= BASE_URL_ADMIN . '?act=sua-mat-khau-ca-nhan-quan-tri' ?>" method="POST">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật Khẩu Cũ:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="old_pass" value="">
                                <?php if (isset($_SESSION['error']['old_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['old_pass']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Mật Khẩu Mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="new_pass" value="">
                                <?php if (isset($_SESSION['error']['new_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['new_pass']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Nhập Lại Mật Khẩu Mới:</label>
                            <div class="col-md-12">
                                <input class="form-control" type="text" name="confirm_pass" value="">
                                <?php if (isset($_SESSION['error']['confirm_pass'])) { ?>
                                    <p class="text-danger"><?= $_SESSION['error']['confirm_pass']; ?></p>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"></label>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary" value="Save Changes">
                                <a href="<?= BASE_URL_ADMIN . '?act=list-tai-khoan-quan-tri' ?>"
                                    class="btn btn-secondary">Back</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <hr>
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