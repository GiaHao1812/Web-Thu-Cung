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
    public function lienHe()
    {

        require_once "./views/lienHe.php";
    }
    public function gioiThieu()
    {

        require_once "./views/gioiThieu.php";
    }

    public function taiKhoan()
    {
        // Giả sử bạn đã có session cho `tai_khoan_id` khi người dùng đăng nhập
        $tai_khoan_id = $_SESSION['tai_khoan_id'] ?? null;
        if ($tai_khoan_id) {
            $donHangModel = new DonHang();
            $listDonHang = $donHangModel->getDonHangByTaiKhoan($tai_khoan_id);

            // Gửi dữ liệu ra view
            require_once "./views/taiKhoan/taiKhoan.php";
        } else {
            echo "Bạn cần đăng nhập để xem lịch sử đơn hàng!";
        }
    }
    public function chiTietDonHang()
    {
        $id_don_hang = $_GET['id_don_hang'] ?? null;
        
        // Kiểm tra ID đơn hàng
        if (!$id_don_hang || !is_numeric($id_don_hang)) {
            header("Location: " . BASE_URL);
            exit();
        }
    
        $donHang = $this->modelDonHang->getDonHangById($id_don_hang);
        if ($donHang) {
            $chiTietSanPham = $this->modelDonHang->getChiTietDonHang($id_don_hang);
            
            // Lấy thông tin sản phẩm cho từng chi tiết đơn hàng
            $sanPhamDetails = [];
            foreach ($chiTietSanPham as $item) {
                $sanPham = $this->modelSanPham->getDetailSanPham($item['san_pham_id']);
                $sanPhamDetails[] = [
                    'san_pham' => $sanPham,
                    'so_luong' => $item['so_luong'],
                    'gia' => $sanPham['gia'], // Hoặc tính toán giá theo nhu cầu
                ];
            }
    
            require_once './views/chiTietDonHang.php';
        } else {
            header("Location: " . BASE_URL);
            exit();
        }
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
            // Lấy email và mật khẩu từ form gửi lên
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Xử lý kiểm tra thông tin đăng nhập
            $user = $this->modelTaiKhoan->checkLogin($email, $password);

            // Kiểm tra nếu $user trả về có dữ liệu (tức là đăng nhập thành công)
            if ($user) { // $user bây giờ phải là mảng chứa thông tin người dùng
                // Lưu thông tin vào session
                $_SESSION['user_client'] = $user['email']; // Lưu email vào session
                $_SESSION['tai_khoan_id'] = $user['id']; // Lưu ID tài khoản vào session

                // Chuyển hướng sau khi đăng nhập thành công
                header("Location:" . BASE_URL);
                exit();
            } else {
                // Đăng nhập thất bại, lưu thông báo lỗi vào session
                $_SESSION['error'] = "Email hoặc mật khẩu không đúng.";
                $_SESSION['flash'] = true;

                // Chuyển hướng về trang đăng nhập
                header("Location:" . BASE_URL . '?act=login');
                exit();
            }
        }
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

    // public function deleteSanPhamFromGioHang()
    // {
    //     // var_dump('acb');
    //     // die();
    //     $id = $_GET['id_gio_hang'];
    //     $gio_hang = $this->modelGioHang->getDetailGioHangFromId($id);


    //     if ($gio_hang) {
    //         $this->modelGioHang->destroySanPhamInGioHang($id);
    //     }

    //     header("Location: " . BASE_URL . '?act=gio-hang');
    //     exit();
    // }
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

            // Xóa giỏ hàng cũ
            // $gio_hang = $this->modelGioHang->getGioHangFromUser($tai_khoan_id);
            // if ($gio_hang) {
            //     $this->modelGioHang->destroyAllSanPhamInGioHang($gio_hang['id']);
            // }

            header("Location:" . BASE_URL . '?act=/');
            exit();
        }
    }
    


}
