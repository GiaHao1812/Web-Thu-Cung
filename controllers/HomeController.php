<?php

class HomeController
{
    public $modelSanPham;
    public $modelTaiKhoan;
    public $modelGioHang;
    public $modelDonHang;
    public function __construct()
    {
        $this->modelSanPham = new SanPham();
        $this->modelTaiKhoan = new TaiKhoan();
        $this->modelGioHang = new GioHang();
        $this->modelDonHang = new DonHang();
    }
    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();

        require_once "./views/home.php";
    }

    public function sanPham()
    {
        $listDanhMuc = $this->modelSanPham->getAllDanhMuc();
        $idDanhMuc = isset($_GET['id_danh_muc']) ? $_GET['id_danh_muc'] : null;

        if ($idDanhMuc) {
            // Truyền $idDanhMuc vào hàm getAllSanPhamToDanhMuc
            $listSanPham = $this->modelSanPham->getAllSanPhamToDanhMuc($idDanhMuc);
        } else {
            $listSanPham = $this->modelSanPham->getAllSanPham();
        }

        require_once "./views/sanPham.php";
    }


    public function chiTietSanPham()
    {
        $id = $_GET['id_san_pham'];

        $sanPham = $this->modelSanPham->getDetailSanPham($id);

        $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);

        $listBinhLuan = $this->modelSanPham->getBinhLuanFromSanPham($id);

        $listSanPhamCungDanhMuc = $this->modelSanPham->getListSanPhamDanhMuc($sanPham['danh_muc_id']);

        if ($sanPham) {
            require_once 'views/detailSanPham.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
    }

    public function formLogin()
    {
        require_once './views/auth/formLogin.php';

        deleteSessionError();
    }

    public function postlogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // lấy email và pass gửi lên từ form

            $email = $_POST['email'];
            $password = $_POST['password'];

            // var_dump($email);
            // die();

            // Xử Lý kiểm tra thông tin đăng nhập

            $user = $this->modelTaiKhoan->checkLogin($email, $password);


            if ($user == $email) { // Trường hợp đăng nhập thành công
                // Lưu thông tin vào session 
                $_SESSION['user_client'] = $user;

                header("Location:" . BASE_URL);
                exit();
            } else {
                // Lỗi thì lưu vào session 
                $_SESSION['error'] = $user;
                // var_dump($_SESSION['error']);die();
                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
    }
    public function formRegister()
    {
        require_once './views/auth/formRegister.php';

        deleteSessionError();
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy thông tin từ form gửi lên
            $hoTen = $_POST['ho_ten'];
            $email = $_POST['email'];
            $password = $_POST['mat_khau'];

            // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
            $user = $this->modelTaiKhoan->registerUser($hoTen, $email, $password);

            if (is_string($user)) { // Trường hợp có lỗi (như email đã tồn tại)
                $_SESSION['error'] = $user;
                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=register');
                exit();
            } else {
                // Nếu đăng ký thành công, đăng nhập người dùng và chuyển hướng
                $_SESSION['user_client'] = $user;

                header("Location:" . BASE_URL);
                exit();
            }
        }
    }

    public function logout()
    {
        // Xóa tất cả session liên quan đến người dùng
        session_start();
        session_unset();
        session_destroy();

        // Chuyển hướng người dùng về trang chủ hoặc trang đăng nhập
        header("Location: " . BASE_URL);
        exit();
    }


    public function addGioHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_SESSION['user_client'])) {
                $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
                // Lấy dữ liệu giỏ hàng từ ngừoi dùng gửi lên
                // var_dump($mail['id']);die;

                $gio_hang = $this->modelGioHang->getGioHangFromUser($mail['id']);

                if (!$gio_hang) {
                    $gio_hangId = $this->modelGioHang->addGioHang($mail['id']);
                    $gio_hang = ['id' => $gio_hangId];
                } else {
                    $chi_tiet_gio_hang = $this->modelGioHang->getDetailGioHangFromId($gio_hang['id']);
                }

                $san_pham_id = $_POST['san_pham_id'];
                $so_luong = $_POST['so_luong'];

                $checkSanPham = false;
                if (isset($chi_tiet_gio_hang)) {
                    foreach ($chi_tiet_gio_hang as $detail) {
                        if ($detail['san_pham_id'] == $san_pham_id) {
                            $newSanPham = $detail['so_luong'] + $so_luong;
                            $this->modelGioHang->updateSoLuong($gio_hang['id'], $san_pham_id, $newSanPham);
                            $checkSanPham = true;
                            break;
                        }
                    }
                }
                if (!$checkSanPham) {
                    $this->modelGioHang->addDetailGioHang($gio_hang['id'], $san_pham_id, $so_luong);
                }
                header("Location:" . BASE_URL . '?act=gio-hang');
            } else {
                var_dump(('Chưa Đăng Nhập'));
                die();
            }
        }
    }
    public function gioHang()
    {
        if (isset($_SESSION['user_client'])) {
            $mail = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng từ ngừoi dùng gửi lên
            // var_dump($mail['id']);die;

            $gio_hang = $this->modelGioHang->getGioHangFromUser($mail['id']);

            if (!$gio_hang) {
                $gio_hangId = $this->modelGioHang->addGioHang($mail['id']);
                $gio_hang = ['id' => $gio_hangId];
                $chi_tiet_gio_hang = $this->modelGioHang->getDetailGioHangFromId($gio_hang['id']);
            } else {
                $chi_tiet_gio_hang = $this->modelGioHang->getDetailGioHangFromId($gio_hang['id']);
            }

            // var_dump($chi_tiet_gio_hang);
            // die;

            require_once './views/gioHang.php';
        } else {
            header("Location:" . BASE_URL . '?act=login');
        }
    }

    public function deleteSanPhamFromGioHang()
    {
        // var_dump('acb');
        // die();
        $id = $_GET['id_gio_hang'];
        $gio_hang = $this->modelGioHang->getDetailGioHangFromId($id);


        if ($gio_hang) {
            $this->modelGioHang->destroySanPhamInGioHang($id);
        }

        header("Location: " . BASE_URL . '?act=gio-hang');
        exit();
    }
    public function thanhToan()
    {
        if (isset($_SESSION['user_client'])) {
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            // Lấy dữ liệu giỏ hàng từ ngừoi dùng gửi lên
            // var_dump($mail['id']);die;

            $gio_hang = $this->modelGioHang->getGioHangFromUser($user['id']);

            if (!$gio_hang) {
                $gio_hangId = $this->modelGioHang->addGioHang($user['id']);
                $gio_hang = ['id' => $gio_hangId];
                $chi_tiet_gio_hang = $this->modelGioHang->getDetailGioHangFromId($gio_hang['id']);
            } else {
                $chi_tiet_gio_hang = $this->modelGioHang->getDetailGioHangFromId($gio_hang['id']);
            }

            // var_dump($chi_tiet_gio_hang);
            // die;

            require_once './views/thanhToan.php';
        } else {
            header("Location:" . BASE_URL . '?act=login');
        }
    }
    public function postthanhToan()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'];
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'];
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'];
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'];
            $ghi_chu = $_POST['ghi_chu'];
            $tong_tien = $_POST['tong_tien'];
            $phuong_thuc_thanh_toan_id = $_POST['phuong_thuc_thanh_toan_id'];
            $ngay_dat = date('Y-m-d ');
            $trang_thai_id = 1;
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH-' . rand(1000, 999999);
            //Thêm Thông tin vào đb
            $this->modelDonHang->addDonHang(
                $tai_khoan_id,
                $ten_nguoi_nhan,
                $email_nguoi_nhan,
                $sdt_nguoi_nhan,
                $dia_chi_nguoi_nhan,
                $ghi_chu,
                $tong_tien,
                $phuong_thuc_thanh_toan_id,
                $ngay_dat,
                $ma_don_hang,
                $trang_thai_id
            );
            header("Location:" . BASE_URL . '?act=/');
        }
    }
}
