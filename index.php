<?php
session_start();
// Require file Common
require_once './commons/env.php'; // Khai báo biến môi trường
require_once './commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/HomeController.php';

// Require toàn bộ file Models
require_once './models/SanPham.php';
require_once './models/TaiKhoan.php';
require_once './models/GioHang.php';
require_once './models/DonHang.php';

// Route
$act = $_GET['act'] ?? '/';
// //
// if($_GET['act']){
//     $act = $_GET['act']; 
// }else{
//     $act = '/';
// }

// Để bảo bảo tính chất chỉ gọi 1 hàm Controller để xử lý request thì mình sử dụng match

match ($act) {
    // Trang chủ\
    '/' => (new HomeController())->home(), //Trường hợp đăc biệt
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    'san-pham' => (new HomeController())->sanPham(),
    // 'post-binh-luan-san-pham' => (new HomeController())->postBinhLuan(),

    // Auth
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'register' => (new HomeController())->formRegister(),
    'check-register' => (new HomeController())->postRegister(),
    'logout' => (new HomeController())->logout(),
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),
    'xoa-gio-hang' => (new HomeController())->deleteSanPhamFromGioHang(),
    'thanh-toan' => (new HomeController())->thanhToan(),
    'xu-ly-thanh-toan' => (new HomeController())->postthanhToan(),
    'huy-don-hang' => (new HomeController())->huyDonHang(),
    'lien-he' => (new HomeController())->lienHe(),
    'gioi-thieu' => (new HomeController())->gioiThieu(),
    'tai-khoan' => (new HomeController())->taiKhoan(),
    'chi-tiet-don-hang' => (new HomeController())->chiTietDonHang(),
};
