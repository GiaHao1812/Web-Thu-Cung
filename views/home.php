<?php require_once 'layout/header.php'; ?>
<?php require_once 'layout/menu.php'; ?>
<main>
    <!-- hero slider area start -->
    <section class="slider-area">
        <div class="hero-slider-active slick-arrow-style slick-arrow-style_hero slick-dot-style">
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider1.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider2.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
            <!-- single slider item start -->
            <div class="hero-single-slide hero-overlay">
                <div class="hero-slider-item bg-img" data-bg="assets/img/slider/slider3.png">
                    <div class="container">
                        <div class="row">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero slider area end -->



    <!-- service policy area start -->
    <div class="service-policy section-padding">
        <div class="container">
            <div class="row mtn-30">
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-plane"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Giao Hàng</h6>
                            <p>Miễn Phí Giao Hàng</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-help2"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hỗ Trợ</h6>
                            <p>Hỗ Trợ 24/07</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-back"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Hoàn Tiền</h6>
                            <p>Hoàn Tiền Trong 30 Ngày Khi Lỗi</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="policy-item">
                        <div class="policy-icon">
                            <i class="pe-7s-credit"></i>
                        </div>
                        <div class="policy-content">
                            <h6>Thanh Toán</h6>
                            <p>Bảo Mật Thanh Toán</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service policy area end -->

    <!-- banner statistics area start -->
    <div class="banner-statistics-area">
        <div class="container">
            <div class="row row-20 mtn-20">
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider1.png" alt="product banner">
                        </a>

                    </figure>
                </div>
                <div class="col-sm-6">
                    <figure class="banner-statistics mt-20">
                        <a href="#">
                            <img src="assets/img/slider/slider2.png" alt="product banner">
                        </a>
                    </figure>
                </div>
            </div>
        </div>
    </div>
    <!-- banner statistics area end -->

    <!-- product area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Sản Phẩm Của Chúng Tôi</h2>
                        <p class="sub-title">Sản Phẩm Được Cập Nhật Liên Tục</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img class="pri-img" style="object-fit: cover; height: 350px;"
                                                        src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" style="object-fit: cover; height: 350px;"
                                                        src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) {
                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart">
                                                        <a class="btn btn-text text-decoration-none"
                                                            href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                            Xem Chi Tiết
                                                        </a>
                                                    </button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">
                                                <h6 class="product-name fs-5">
                                                    <a
                                                        href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                        <?= $sanPham['ten_san_pham'] ?>
                                                    </a>
                                                </h6>
                                                <div class="price-box">
                                                    <!-- Chỉ hiển thị giá gốc -->
                                                    <span class="price-regular">
                                                        <?= fomatPrice($sanPham['gia_san_pham']) . "đ"; ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <!-- product item end -->
                                </div>
                            </div>
                        </div>

                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product area end -->

    <!-- product banner statistics area start -->
    <section class="product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Giá Khuyến Mãi</h2>
                        <p class="sub-title">Sản Phẩm Của Chúng Tôi</p>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="product-container">

                        <!-- product tab content start -->
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab1">
                                <div class="product-carousel-4 slick-row-10 slick-arrow-style">
                                    <!-- product item start -->
                                    <?php foreach ($listSanPham as $key => $sanPham): ?>
                                        <div class="product-item">
                                            <figure class="product-thumb">
                                                <a
                                                    href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">
                                                    <img class="pri-img" style="object-fit: cover; height: 350px;"
                                                        src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                    <img class="sec-img" style="object-fit: cover; height: 350px;"
                                                        src="<?= BASE_URL . $sanPham['hinh_anh'] ?>" alt="product">
                                                </a>
                                                <div class="product-badge">
                                                    <?php
                                                    $ngayNhap = new DateTime($sanPham['ngay_nhap']);
                                                    $ngayHienTai = new DateTime();
                                                    $tinhNgay = $ngayHienTai->diff($ngayNhap);

                                                    if ($tinhNgay->days <= 7) {
                                                    ?>
                                                        <div class="product-label new">
                                                            <span>Mới</span>
                                                        </div>
                                                    <?php } ?>

                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <div class="product-label discount">
                                                            <span>Giảm giá</span>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                                <div class="cart-hover">
                                                    <button class="btn btn-cart"><a
                                                            class="btn btn-text text-decoration-none"
                                                            href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>">Xem
                                                            Chi Tiết</a></button>
                                                </div>
                                            </figure>
                                            <div class="product-caption text-center">

                                                <h6 class="product-name fs-5">
                                                    <a
                                                        href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']; ?>"><?= $sanPham['ten_san_pham'] ?></a>
                                                </h6>
                                                <div class="price-box">
                                                    <?php if ($sanPham['gia_khuyen_mai']) { ?>
                                                        <span
                                                            class="price-regular"><?= fomatPrice($sanPham['gia_khuyen_mai']) . "đ"; ?></span>
                                                        <span
                                                            class="price-old"><del><?= fomatPrice($sanPham['gia_san_pham']) . "đ" ?></del></span>
                                                    <?php } else { ?>
                                                        <span
                                                            class="price-regular"><?= fomatPrice($sanPham['gia_san_pham']) . "đ"; ?></span>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                    <!-- product item end -->
                                </div>
                            </div>
                        </div>
                        <!-- product tab content end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product banner statistics area end -->



    <!-- testimonial area start -->
    <section class="testimonial-area section-padding bg-img" data-bg="assets/img/bg-thu-cung.jpg">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- section title start -->
                    <div class="section-title text-center">
                        <h2 class="title">Một số Feedbeck của Khách Hàng</h2>
                    </div>
                    <!-- section title start -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-thumb-wrapper">
                        <div class="testimonial-thumb-carousel">
                            <div class="testimonial-thumb">
                                <img src="assets/img/user1.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/user2.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/user3.png" alt="testimonial-thumb">
                            </div>
                            <div class="testimonial-thumb">
                                <img src="assets/img/user4.jpg" alt="testimonial-thumb">
                            </div>
                        </div>
                    </div>
                    <div class="testimonial-content-wrapper">
                        <div class="testimonial-content-carousel">
                            <div class="testimonial-content">
                                <p>Mình đã mua một bé Golden Retriever từ trang này, và thực sự hài lòng với dịch vụ.
                                    Chó rất khỏe mạnh, nhanh nhẹn và đã được tiêm phòng đầy đủ. Nhân viên hỗ trợ nhiệt
                                    tình, trả lời mọi thắc mắc của mình trước khi quyết định mua. Bé về nhà rất nhanh
                                    hòa nhập với gia đình và dễ huấn luyện. Rất đáng tiền!</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Phạm Minh Quang</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mình mua một bé mèo Anh lông ngắn từ trang web này. Mèo rất đáng yêu, lông mềm mịn và
                                    không hề sợ người. Tuy nhiên, thời gian giao hàng hơi chậm so với mong đợi. Bù lại,
                                    bé được chăm sóc tốt và có đầy đủ giấy tờ tiêm chủng. Nếu dịch vụ vận chuyển nhanh
                                    hơn thì sẽ hoàn hảo!</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Nguyễn Đức Vinh</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Trang web này thực sự uy tín. Mình đã chọn một bé Corgi, chó con rất khỏe mạnh, vui
                                    tươi và năng động. Chỉ có một điều nhỏ là không có nhiều thông tin về cách chăm sóc
                                    ban đầu trên trang, nhưng nhân viên đã cung cấp thêm hướng dẫn rất chi tiết sau khi
                                    mua. Rất vui vì đã chọn được một người bạn đồng hành tuyệt vời!</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Nguyễn Thế Anh</h5>
                            </div>
                            <div class="testimonial-content">
                                <p>Mèo Ba Tư mình mua trên trang thật sự rất đẹp và thuần chủng. Giao hàng đúng hẹn và
                                    mèo không có dấu hiệu mệt mỏi hay căng thẳng sau hành trình. Trang web còn cung cấp
                                    đầy đủ thức ăn và vật dụng kèm theo, nên mình không phải lo lắng gì nhiều. Mình chắc
                                    chắn sẽ quay lại nếu cần thêm thú cưng!</p>
                                <div class="ratings">
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                    <span><i class="fa fa-star-o"></i></span>
                                </div>
                                <h5 class="testimonial-author">Trần Hồng Phúc</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- testimonial area end -->
</main>
<?php require_once "layout/miniCart.php"; ?>

<?php require_once "layout/footer.php"; ?>