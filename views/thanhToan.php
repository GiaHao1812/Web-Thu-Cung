<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>


<main>
    <!-- breadcrumb area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-wrap">
                        <nav aria-label="breadcrumb">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Thanh Toán</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- checkout main wrapper start -->
    <div class="checkout-page-wrapper section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Checkout Login Coupon Accordion Start -->
                    <div class="checkoutaccordion" id="checkOutAccordion">


                        <!-- <div class="card">
                            <h6>Thêm Mã Giảm Giá <span data-bs-toggle="collapse" data-bs-target="#couponaccordion">
                                    Nhập mã code</span></h6>
                            <div id="couponaccordion" class="collapse" data-parent="#checkOutAccordion">
                                <div class="card-body">
                                    <div class="cart-update-option">
                                        <div class="apply-coupon-wrapper">
                                            <form action="#" method="post" class=" d-block d-md-flex">
                                                <input type="text" placeholder="Vui lòng nhập code" required />
                                                <button class="btn btn-sqr">Áp mã code</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                    <!-- Checkout Login Coupon Accordion End -->
                </div>
            </div>
            <form action="<?= BASE_URL . "?act=xu-ly-thanh-toan" ?>" method="POST">
                <div class="row">
                    <!-- Checkout Billing Details -->
                    <div class="col-lg-6">
                        <div class="checkout-billing-details-wrap">
                            <h5 class="checkout-title">Thông Tin Người Nhận</h5>
                            <div class="billing-form-wrap">



                                <div class="single-input-item">
                                    <label for="ten_nguoi_nhan" class="required">Tên Người Nhận</label>
                                    <input type="text" id="ten_nguoi_nhan" name="ten_nguoi_nhan"
                                        value="<?= $user['ho_ten'] ?>" placeholder="Tên Người Nhận" required />
                                </div>
                                <div class="single-input-item">
                                    <label for="email" class="required">Địa Chỉ Email </label>
                                    <input type="email" id="email_nguoi_nhan" name="email_nguoi_nhan"
                                        value="<?= $user['email'] ?>" placeholder="Địa Chỉ Email" required />
                                </div>
                                <div class="single-input-item">
                                    <label for="sdt_nguoi_nhan" class="required">SĐT Người Nhận</label>
                                    <input type="text" id="sdt_nguoi_nhan" name="sdt_nguoi_nhan"
                                        value="<?= isset($_SESSION['old_data']['sdt_nguoi_nhan']) ? $_SESSION['old_data']['sdt_nguoi_nhan'] : '' ?>"
                                        placeholder="SĐT Người Nhận" />
                                    <?php if (isset($_SESSION['errors']['sdt_nguoi_nhan'])): ?>
                                        <div class="error" style="color: red;"><?= $_SESSION['errors']['sdt_nguoi_nhan'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="single-input-item">
                                    <label for="dia_chi_nguoi_nhan" class="required">Địa Chỉ Người Nhận</label>
                                    <input type="text" id="dia_chi_nguoi_nhan" name="dia_chi_nguoi_nhan"
                                        value="<?= isset($_SESSION['old_data']['dia_chi_nguoi_nhan']) ? $_SESSION['old_data']['dia_chi_nguoi_nhan'] : '' ?>"
                                        placeholder="Địa Chỉ Người Nhận" />
                                    <?php if (isset($_SESSION['errors']['dia_chi_nguoi_nhan'])): ?>
                                        <div class="error" style="color: red;">
                                            <?= $_SESSION['errors']['dia_chi_nguoi_nhan'] ?></div>
                                    <?php endif; ?>
                                </div>


                                <div class="single-input-item">
                                    <label for="ghi_chu">Ghi Chú</label>
                                    <textarea name="ghi_chu" id="ghi_chu" cols="30" rows="3"
                                        placeholder="Vui lòng nhập ghi chú đơn hàng của bạn"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Order Summary Details -->
                    <div class="col-lg-6">
                        <div class="order-summary-details">
                            <h5 class="checkout-title">Thanh Toán Sản Phẩm</h5>
                            <div class="order-summary-content">
                                <!-- Order Summary Table -->
                                <div class="order-summary-table table-responsive text-center">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sản Phẩm</th>
                                                <th>Tổng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $tongGioHang = 0;
                                            foreach ($chi_tiet_gio_hang as $key => $sanPham):

                                                ?>
                                                <tr>
                                                    <td><a href=""><?= $sanPham['ten_san_pham'] ?> <strong> x
                                                                <?= $sanPham['so_luong'] ?></strong></a>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $tong_tien = 0;
                                                        if ($sanPham['gia_khuyen_mai']) {
                                                            $tong_tien = $sanPham['gia_khuyen_mai'] * $sanPham['so_luong'];
                                                        } else {
                                                            $tong_tien = $sanPham['gia_san_pham'] * $sanPham['so_luong'];
                                                        }
                                                        $tongGioHang += $tong_tien;
                                                        echo fomatPrice($tong_tien) . 'đ';
                                                        ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td>Tổng Tiền</td>
                                                <td><strong><?= fomatPrice($tongGioHang) . 'đ' ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td>Vận Chuyển</td>
                                                <td class="d-flex justify-content-center">
                                                    <strong>40.000đ</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <input type="hidden" name="tong_tien"
                                                    value="<?= $tongGioHang + 40000 ?>">
                                                <td>Tổng Đơn Hàng</td>
                                                <td><strong><?= fomatPrice($tongGioHang + 40000) . 'đ' ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- Order Payment Method -->
                                <div class="order-payment-method">
                                    <div class="single-payment-method show">
                                        <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="cashon" value="1"
                                                    name="phuong_thuc_thanh_toan_id" class="custom-control-input"
                                                    checked />
                                                <label class="custom-control-label" for="cashon">Thanh Toán Khi Nhận
                                                    Hàng</label>
                                            </div>
                                        </div>
                                        <div class="payment-method-details" data-method="cash">
                                            <p>Thanh Toán Sau Khi Đã Nhận Hàng Thành Công</p>
                                        </div>
                                    </div>
                                    <div class="single-payment-method">
                                        <!-- <div class="payment-method-name">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="directbank" value="2"
                                                    name="phuong_thuc_thanh_toan_id" class="custom-control-input" />
                                                <label class="custom-control-label" for="directbank">Thanh Toán
                                                    Online</label>
                                            </div>
                                        </div> 
                                    <div class="payment-method-details" data-method="bank">
                                        <p>Khách Hàng Cần Thanh Toán Trước</p>
                                    </div> -->
                                    </div>

                                    <div class="summary-footer-area">
                                        <div class="custom-control custom-checkbox mb-20">
                                            <input type="checkbox" class="custom-control-input" id="terms" required />
                                            <label class="custom-control-label" for="terms">Xác Nhận Đặt Hàng </label>
                                        </div>
                                        <button type="submit" class="btn btn-sqr">Tiến Hành Đặt Hàng</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout main wrapper end -->
</main>

<?php require_once "layout/miniCart.php"; ?>
<?php require_once "layout/footer.php"; ?>