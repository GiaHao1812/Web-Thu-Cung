<?php
session_start();
// Require file Common
require_once '../commons/env.php'; // Khai báo biến môi trường
require_once '../commons/function.php'; // Hàm hỗ trợ

// Require toàn bộ file Controllers
require_once './controllers/AdminDanhMucController.php';
require_once './controllers/AdminSanPhamController.php';
<<<<<<< HEAD
require_once './controllers/AdminBaoCaoThongKeController.php';
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminDonHangController.php';

=======
require_once './controllers/AdminTaiKhoanController.php';
require_once './controllers/AdminBaoCaoThongKeController.php';
>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
// Require toàn bộ file Models
require_once './models/AdminDanhMuc.php';
require_once './models/AdminSanPham.php';
require_once './models/AdminTaiKhoan.php';
<<<<<<< HEAD
require_once './models/AdminDonHang.php';
=======



>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958

// Route
$act = $_GET['act'] ?? '/';

if ($act !== 'login-admin' && $act !== 'check-login-admin' && $act !== 'logout-admin') {
  checkLoginAdmin();
}
<<<<<<< HEAD
=======

>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
match ($act) {

  // route Bao Cao Thong Ke 
  '/' => (new AdminBaoCaoThongKeController())->home(),
<<<<<<< HEAD
  // route danh muc

  'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
  'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
  'them-danh-muc' => (new AdminDanhMucController())->postDanhMuc(),
  'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
  'sua-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc(),
  'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),


=======


  // route danh muc

  'danh-muc' => (new AdminDanhMucController())->danhSachDanhMuc(),
  'form-them-danh-muc' => (new AdminDanhMucController())->formAddDanhMuc(),
  'them-danh-muc' => (new AdminDanhMucController())->postDanhMuc(),
  'form-sua-danh-muc' => (new AdminDanhMucController())->formEditDanhMuc(),
  'sua-danh-muc' => (new AdminDanhMucController())->postEditDanhMuc(),
  'xoa-danh-muc' => (new AdminDanhMucController())->deleteDanhMuc(),


>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
  // route san pham 

  'san-pham' => (new AdminSanPhamController())->danhSachSanPham(),
  'form-them-san-pham' => (new AdminSanPhamController())->formAddSanPham(),
  'them-san-pham' => (new AdminSanPhamController())->postAddSanPham(),
  'form-sua-san-pham' => (new AdminSanPhamController())->formEditSanPham(),
  'sua-san-pham' => (new AdminSanPhamController())->postEditSanPham(),
  'sua-album-anh-san-pham' => (new AdminSanPhamController())->postEditAnhSanPham(),
  'xoa-san-pham' => (new AdminSanPhamController())->deleteSanPham(),
  'chi-tiet-san-pham' => (new AdminSanPhamController())->detailSanPham(),

<<<<<<< HEAD
  // route don hang

  'don-hang' => (new AdminDonHangController())->danhSachDonHang(),
  'form-sua-don-hang' => (new AdminDonHangController())->formEditDonHang(),
  'sua-don-hang' => (new AdminDonHangController())->postEditDonHang(),
  'chi-tiet-don-hang' => (new AdminDonHangController())->detailDonHang(),

  // route binh luan
  'update-trang-thai-binh-luan' => (new AdminSanPhamController())->updateTrangThaiBinhLuan(),

  // route don hang
=======
>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
  // route Quản lý toàn khoản
  // Quản lý tài khoản quản trị
  'list-tai-khoan-quan-tri' => (new AdminTaiKhoanController())->danhSachQuanTri(),
  'form-them-quan-tri' => (new AdminTaiKhoanController())->formAddQuanTri(),
  'them-quan-tri' => (new AdminTaiKhoanController())->postAddQuanTri(),
  'form-sua-quan-tri' => (new AdminTaiKhoanController())->formEditQuanTri(),
  'sua-quan-tri' => (new AdminTaiKhoanController())->postEditQuanTri(),

<<<<<<< HEAD
=======

>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
  // Quản lý tài khoản khách hàng 
  'list-tai-khoan-khach-hang' => (new AdminTaiKhoanController())->danhSachKhachHang(),
  'form-sua-khach-hang' => (new AdminTaiKhoanController())->formEditKhachHang(),
  'sua-khach-hang' => (new AdminTaiKhoanController())->postEditKhachHang(),
<<<<<<< HEAD
  'chi-tiet-khach-hang' => (new AdminTaiKhoanController())->detailKhachHang(),

  // route quản lí tài khoản cá nhân(quản trị)
  'form-sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->formEditCaNhanQuanTri(),
  // 'sua-thong-tin-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditCaNhanQuanTri(),

  'sua-mat-khau-ca-nhan-quan-tri' => (new AdminTaiKhoanController())->postEditMatKhauCaNhan(),
=======

>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958

  // route reset password tài khoản
  'reset-password' => (new AdminTaiKhoanController())->resetPassword(),

<<<<<<< HEAD
=======


>>>>>>> 26f130b16b0c4010214c2f3ca0a4758120a7e958
  // route auth

  'login-admin' => (new AdminTaiKhoanController())->formLogin(),
  'check-login-admin' => (new AdminTaiKhoanController())->login(),
  'logout-admin' => (new AdminTaiKhoanController())->logout(),
};
