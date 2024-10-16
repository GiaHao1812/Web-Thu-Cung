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
                                <li class="breadcrumb-item"><a href="<?= BASE_URL ?>"><i class="fa fa-home"></i></a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop</li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb area end -->

    <!-- page main wrapper start -->
    <div class="shop-main-wrapper section-padding">
        <div class="container">
            <div class="row">
                <!-- sidebar area start -->
                <div class="col-lg-3 order-2 order-lg-1">
                    <aside class="sidebar-wrapper">
                        <!-- single sidebar start -->
                        <div class="sidebar-single">
                            <h5 class="sidebar-title">Danh Mục</h5>
                            <div class="sidebar-body">
                                <ul class="shop-categories h6">
                                    <?php foreach ($listDanhMuc as $danhMuc): ?>
                                        <li>
                                            <a href="<?= BASE_URL . '?act=san-pham&id_danh_muc=' . $danhMuc['id'] ?>">
                                                <?= $danhMuc['ten_danh_muc'] ?>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>


                            </div>
                            <!-- single sidebar end -->

                            <!-- single sidebar start -->
                            <div class="sidebar-banner mt-5">
                                <div class="img-container">
                                    <a href="#">
                                        <img style="height: 288px; object-fit:cover" src="assets/img/banner/chomeo.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- single sidebar end -->
                    </aside>
                </div>
                <!-- sidebar area end -->

                <!-- shop main wrapper start -->
                <div class="col-9 order-1">
                    <div class="shop">
                        <!-- product item list wrapper start -->
                        <div class="row mbn-30 d-flex">
                            <!-- product single item start -->
                            <?php foreach ($listSanPham as $sanPham): ?>
                                <div class="col-md-3 col-sm-6 d-flex align-items-stretch">
                                    <!-- product grid start -->
                                    <div class="product-item">
                                        <figure class="product-thumb">
                                            <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                <img class="pri-img" style="object-fit: cover; height: 300px;" src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                            </a>
                                            <div class="product-badge">
                                                <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                    <div class="product-label discount">
                                                        <span>Giảm giá</span>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </figure>
                                        <div class="product-caption text-center">
                                            <h6 class="product-name">
                                                <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= htmlspecialchars($sanPham['ten_san_pham']) ?></a>
                                            </h6>
                                            <div class="price-box">
                                                <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                    <span class="price-regular"><?= fomatPrice($sanPham['gia_khuyen_mai']) . "đ"; ?></span>
                                                    <span class="price-old"><del><?= fomatPrice($sanPham['gia_san_pham']) . "đ" ?></del></span>
                                                <?php } else { ?>
                                                    <span class="price-regular"><?= fomatPrice($sanPham['gia_san_pham']) . "đ"; ?></span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- product grid end -->
                                </div>
                            <?php endforeach; ?>
                            <!-- product single item end -->
                        </div>
                        <!-- product item list wrapper end -->
                    </div>
                </div>


                <!-- shop main wrapper end -->
            </div>
        </div>
    </div>
    <!-- page main wrapper end -->
</main>
<?php require_once "layout/miniCart.php"; ?>

<?php require_once "layout/footer.php"; ?>