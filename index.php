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
<<<<<<< HEAD
    '/' => (new HomeController())->home(), //Trường hợp đăc biệt
    'chi-tiet-san-pham' => (new HomeController())->chiTietSanPham(),
    // Auth
    'login' => (new HomeController())->formLogin(),
    'check-login' => (new HomeController())->postLogin(),
    'them-gio-hang' => (new HomeController())->addGioHang(),
    'gio-hang' => (new HomeController())->gioHang(),
};
=======
    '/' => (new HomeController())->home(),//Trường hợp đăc biệt
    'trangchu' => (new HomeController())->trangChu(),
    //BASE_URL/?act=trangchu
    'danh-sach-san-pham' => (new HomeController())->danhSachSanPham(),
//BASE_URL/?act=danh-sach-san-pham

};
>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
