<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>


<div class="my-account-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <!-- My Account Page Start -->
                    <div class="myaccount-page-wrapper">
                        <!-- My Account Tab Menu Start -->
                        <div class="row">
                            <div class="col-lg-3 col-md-4">
                                <div class="myaccount-tab-menu nav" role="tablist">

                                    <a href="#orders" data-bs-toggle="tab"><i class="fa fa-cart-arrow-down"></i>
                                        Đơn hàng</a>

                                    <a href="#payment-method" data-bs-toggle="tab"><i class="fa fa-credit-card"></i>
                                        Payment
                                        Method</a>
                                    <a href="#address-edit" data-bs-toggle="tab"><i class="fa fa-map-marker"></i>
                                        address</a>
                                    <a href="#account-info" data-bs-toggle="tab"><i class="fa fa-user"></i> Account
                                        Details</a>
                                    <a href="<?= BASE_URL . "?act=logout" ?>"><i class="fa fa-sign-out"></i> Logout</a>
                                </div>
                            </div>
                            <!-- My Account Tab Menu End -->

                            <!-- My Account Tab Content Start -->
                            <div class="col-lg-9 col-md-8">
                                <div class="tab-content" id="myaccountContent">
                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="orders" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Orders</h5>
                                            <div class="myaccount-table table-responsive text-center">
                                                <table class="table table-bordered">
                                                    <thead class="thead-light">
                                                        <tr>
                                                            <th>Đơn Hàng</th>
                                                            <th>Ngày Đặt</th>
                                                            <th>Trạng Thái</th>
                                                            <th>Tổng Tiền</th>
                                                            <th>Thao Tác</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($listDonHang as $donHang): ?>
                                                            <tr>
                                                                <td><?= htmlspecialchars($donHang['ma_don_hang']); ?></td>
                                                                <td><?= htmlspecialchars($donHang['ngay_dat']); ?></td>
                                                                <td>
                                                                    <?php
                                                                    // Hiển thị trạng thái
                                                                    switch ($donHang['trang_thai_id']) {
                                                                        case 1:
                                                                            echo 'Chưa Xác Nhận';
                                                                            break;
                                                                        case 2:
                                                                            echo 'Đã Xác Nhận';
                                                                            break;
                                                                        case 3:
                                                                            echo 'Chưa Thanh Toán';
                                                                            break;
                                                                        case 4:
                                                                            echo 'Đã Thanh Toán';
                                                                            break;
                                                                        case 5:
                                                                            echo 'Đang Chuẩn Bị Hàng';
                                                                            break;
                                                                        case 6:
                                                                            echo 'Đang Giao Hàng';
                                                                            break;
                                                                        case 7:
                                                                            echo 'Đã Giao Hàng';
                                                                            break;
                                                                        case 8:
                                                                            echo 'Đã Nhận Hàng';
                                                                            break;
                                                                        case 9:
                                                                            echo 'Thành Công';
                                                                            break;

                                                                        case 10:
                                                                            echo 'Hoàn Hàng';
                                                                            break;
                                                                        case 11:
                                                                            echo 'Hủy Đơn';
                                                                            break;

                                                                        default:
                                                                            echo 'Đang xử lý';
                                                                            break;
                                                                    }
                                                                    ?>
                                                                </td>

                                                                <td><?= number_format($donHang['tong_tien'], 2) . ' đ'; ?>
                                                                </td>
                                                                <td>
                                                                    <a href="<?= BASE_URL . '?act=chi-tiet-don-hang&id_don_hang=' . $donHang['id'] ?>"
                                                                        class="btn btn-sqr">View</a>
                                                                </td>

                                                                <td><?= number_format($donHang['tong_tien']) . 'đ'; ?>
                                                                </td>
                                                                <td>
                                                                    <form action="<?= BASE_URL . '?act=huy-don-hang' ?>" method="POST">
                                                                        <input type="hidden" name="id_don_hang" value="<?= $donHang['id']; ?>"> <!-- Truyền ID đơn hàng -->
                                                                        <button type="submit" class="btn btn-sqr mt-4" onclick="return confirm('Bạn muốn hủy đơn?')">Hủy đơn</button>
                                                                    </form>



                                                                </td>

                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>


                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->

                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="payment-method" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Payment Method</h5>
                                            <p class="saved-message">You Can't Saved Your Payment Method yet.</p>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="address-edit" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Billing Address</h5>
                                            <address>
                                                <p><strong>Erik Jhonson</strong></p>
                                                <p>1355 Market St, Suite 900 <br>
                                                    San Francisco, CA 94103</p>
                                                <p>Mobile: (123) 456-7890</p>
                                            </address>
                                            <a href="#" class="btn btn-sqr"><i class="fa fa-edit"></i>
                                                Edit Address</a>
                                        </div>
                                    </div>
                                    <!-- Single Tab Content End -->

                                    <!-- Single Tab Content Start -->
                                    <div class="tab-pane fade" id="account-info" role="tabpanel">
                                        <div class="myaccount-content">
                                            <h5>Account Details</h5>
                                            <div class="account-details-form">
                                                <form action="#">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="first-name" class="required">First
                                                                    Name</label>
                                                                <input type="text" id="first-name"
                                                                    placeholder="First Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="single-input-item">
                                                                <label for="last-name" class="required">Last
                                                                    Name</label>
                                                                <input type="text" id="last-name"
                                                                    placeholder="Last Name" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="display-name" class="required">Display Name</label>
                                                        <input type="text" id="display-name"
                                                            placeholder="Display Name" />
                                                    </div>
                                                    <div class="single-input-item">
                                                        <label for="email" class="required">Email Addres</label>
                                                        <input type="email" id="email" placeholder="Email Address" />
                                                    </div>
                                                    <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="single-input-item">
                                                            <label for="current-pwd" class="required">Current
                                                                Password</label>
                                                            <input type="password" id="current-pwd"
                                                                placeholder="Current Password" />
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="new-pwd" class="required">New
                                                                        Password</label>
                                                                    <input type="password" id="new-pwd"
                                                                        placeholder="New Password" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="single-input-item">
                                                                    <label for="confirm-pwd" class="required">Confirm
                                                                        Password</label>
                                                                    <input type="password" id="confirm-pwd"
                                                                        placeholder="Confirm Password" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="single-input-item">
                                                        <button class="btn btn-sqr">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div> <!-- Single Tab Content End -->
                                </div>
                            </div> <!-- My Account Tab Content End -->
                        </div>
                    </div> <!-- My Account Page End -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once "views/layout/footer.php"; ?>