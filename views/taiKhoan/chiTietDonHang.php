<?php require_once 'views/layout/header.php'; ?>
<?php require_once 'views/layout/menu.php'; ?>

<div class="order-detail-wrapper section-padding">
    <div class="container">
        <div class="section-bg-color">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Chi Tiết Sản Phẩm</h2>
                    <div class="cart-table table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="pro-title">Tên Sản Phẩm</th>
                                    <th class="pro-price">Giá</th>
                                    <th class="pro-quantity">Số Lượng</th>
                                    <th class="pro-subtotal">Tổng Tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($chiTietSanPham)): ?>
                                    <?php foreach ($chiTietSanPham as $item): ?>
                                        <tr>
                                            <td class="pro-title"><?= htmlspecialchars($item['ten_san_pham']) ?></td>
                                            <td class="pro-price">
                                                <span>
                                                    <?php if (!empty($item['gia_khuyen_mai'])): ?>
                                                        <?= fomatPrice($item['gia_khuyen_mai']) . 'đ' ?>
                                                    <?php else: ?>
                                                        <?= fomatPrice($item['gia_san_pham']) . 'đ' ?>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                            <!-- <td class="pro-quantity"><?= htmlspecialchars($item['so_luong']) ?></td> -->
                                            <td class="pro-subtotal"><span>
                                                    <?php
                                                    $tong_tien = !empty($item['gia_khuyen_mai']) ? $item['gia_khuyen_mai'] * $item['so_luong'] : $item['gia_san_pham'] * $item['so_luong'];
                                                    echo fomatPrice($tong_tien) . 'đ';
                                                    ?>
                                                </span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4" class="text-center">Không có sản phẩm nào trong đơn hàng này.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>

                        </table>
                    </div>

                    <a href="<?= BASE_URL . '?act=tai-khoan' ?>" class="btn btn-sqr d-block">Trở về</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once "views/layout/footer.php"; ?>