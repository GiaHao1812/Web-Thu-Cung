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
            require_once "./views/auth/formLogin.php";
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

        // Lấy thông tin đơn hàng theo ID
        $donHang = $this->modelDonHang->getDonHangById($id_don_hang);
        if ($donHang) {
            // Gọi đúng tên phương thức đã đổi

            // // Kiểm tra ID đơn hàng
            // if (!$id_don_hang || !is_numeric($id_don_hang)) {
            //     header("Location: " . BASE_URL);
            //     exit();
            // }

            $donHang = $this->modelDonHang->getDonHangById($id_don_hang);
            if ($donHang) {

                $chiTietSanPham = $this->modelDonHang->getDetailSanPhamCuaDonHang($id_don_hang);
                // var_dump($chiTietSanPham);
                // die();
                // Lấy thông tin sản phẩm cho từng chi tiết đơn hàng
                $sanPhamDetails = [];
                foreach ($chiTietSanPham as $item) {
                    $sanPham = $this->modelSanPham->getDetailSanPham($item['san_pham_id']); // Sử dụng 'san_pham_id' để lấy thông tin sản phẩm
                    $sanPhamDetails[] = [
                        'san_pham' => $sanPham,
                        'so_luong' => $item['so_luong'],
                        'gia' => $sanPham['gia'], // Hoặc tính toán giá theo nhu cầu
                        'thanh_tien' => $item['thanh_tien'], // Thêm thông tin thành tiền
                    ];
                }



                // Hiển thị thông tin chi tiết đơn hàng


                require_once './views/taiKhoan/chiTietDonHang.php';
            } else {
                header("Location: " . BASE_URL);
                exit();
            }
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

    public function postLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy email và mật khẩu từ form gửi lên
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Mảng lưu các thông báo lỗi
            $errors = [];

            // Kiểm tra email
            if (empty($email)) {
                $errors[] = "Email không được để trống.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Email không đúng định dạng.";
            }

            // Kiểm tra mật khẩu
            if (empty($password)) {
                $errors[] = "Mật khẩu không được để trống.";
            }

            // Nếu có lỗi, lưu vào session và trả về trang đăng nhập
            if (!empty($errors)) {
                $_SESSION['error'] = implode("<br>", $errors); // Gộp các lỗi thành chuỗi
                $_SESSION['flash'] = true;

                header("Location:" . BASE_URL . '?act=login');
                exit();
            }

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





    public function formRegister()
    {
        require_once './views/auth/formRegister.php';

        deleteSessionError();
    }

    public function postRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Lấy thông tin từ form gửi lên


            // Lấy thông tin từ form gửi lên

            $hoTen = $_POST['ho_ten'];
            $email = $_POST['email'];
            $password = $_POST['mat_khau'];



            //Kiểm tra email đã tồn tại chưa
            $user = $this->modelTaiKhoan->registerUser($hoTen, $email, $password);

            if (is_string($user)) {
                $_SESSION['error'] = $user;

                // Mảng lưu các thông báo lỗi
                $errors = [];

                // Kiểm tra họ tên không được để trống
                if (empty($hoTen)) {
                    $errors[] = "Họ tên không được để trống.";
                }

                // Kiểm tra định dạng email
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Email không đúng định dạng.";
                }

                // Kiểm tra độ dài mật khẩu phải lớn hơn 6 ký tự
                if (strlen($password) <= 6) {
                    $errors[] = "Mật khẩu phải có độ dài lớn hơn 6 ký tự.";
                }

                // Nếu có lỗi, lưu vào session và trả về trang đăng ký
                if (!empty($errors)) {
                    $_SESSION['error'] = implode("<br>", $errors); // Gộp các lỗi thành chuỗi

                    $_SESSION['flash'] = true;

                    header("Location:" . BASE_URL . '?act=register');
                    exit();

                } else {
                    //Đăng ký thành công và chuyển hướng về trang đăng nhập
                    $_SESSION['success'] = $user;
                    header("Location:" . BASE_URL);
                    exit();
                }
            }
        }
        // Nếu không có lỗi, gọi phương thức registerUser từ model để đăng ký người dùng
        $result = $this->modelTaiKhoan->registerUser($hoTen, $email, $password);

        if (is_string($result)) { // Trường hợp có lỗi như email đã tồn tại
            $_SESSION['error'] = $result;
            $_SESSION['flash'] = true;
            header("Location:" . BASE_URL . '?act=register');
            exit();
        }

        // Nếu đăng ký thành công, chuyển hướng đến trang đăng nhập
        $_SESSION['success'] = "Đăng ký thành công, vui lòng đăng nhập.";
        header("Location:" . BASE_URL . '?act=login');
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
                header("Location:" . BASE_URL . "?act=login");
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
    //     // Lấy id của giỏ hàng và sản phẩm từ URL
    //     $id_gio_hang = $_GET['id_gio_hang'] ?? null;
    //     $san_pham_id = $_GET['san_pham_id'] ?? null;

    //     // Kiểm tra id_gio_hang và san_pham_id có tồn tại và hợp lệ
    //     if ($id_gio_hang && $san_pham_id) {
    //         // Lấy chi tiết giỏ hàng từ id
    //         $gio_hang = $this->modelGioHang->getDetailGioHangFromId($id_gio_hang);

    //         if ($gio_hang) {
    //             // Gọi hàm xóa sản phẩm trong giỏ hàng
    //             $this->modelGioHang->destroySanPhamInGioHang($san_pham_id);
    //         }
    //     }

    //     // Điều hướng về trang giỏ hàng
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
    public function postthanhToan($id)
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
            $errors = [];

            // Kiểm tra các trường bắt buộc
            if (empty($ten_nguoi_nhan)) {
                $errors['ten_nguoi_nhan'] = "Vui lòng nhập tên người nhận.";
            }

            if (empty($email_nguoi_nhan)) {
                $errors['email_nguoi_nhan'] = "Vui lòng nhập địa chỉ email.";
            } elseif (!filter_var($email_nguoi_nhan, FILTER_VALIDATE_EMAIL)) {
                $errors['email_nguoi_nhan'] = "Địa chỉ email không hợp lệ.";
            }

            if (empty($sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = "Vui lòng nhập số điện thoại.";
            } elseif (!preg_match('/^[0-9]{10}$/', $sdt_nguoi_nhan)) {
                $errors['sdt_nguoi_nhan'] = "Số điện thoại không hợp lệ.";
            }

            if (empty($dia_chi_nguoi_nhan)) {
                $errors['dia_chi_nguoi_nhan'] = "Vui lòng nhập địa chỉ.";
            }

            // Nếu có lỗi, trả lại trang thanh toán và hiển thị lỗi
            if (!empty($errors)) {
                // Lưu lỗi vào session để hiển thị
                $_SESSION['errors'] = $errors;
                $_SESSION['old_data'] = $_POST; // Lưu dữ liệu cũ để giữ lại giá trị đã nhập
                header("Location: " . BASE_URL . "?act=thanh-toan");
                exit();
            }

            // Nếu không có lỗi, xử lý đơn hàng
            $user = $this->modelTaiKhoan->getTaiKhoanFromEmail($_SESSION['user_client']);
            $tai_khoan_id = $user['id'];
            $ma_don_hang = 'DH-' . rand(1000, 999999);
            //Thêm Thông tin vào đb
            $donHangThanhToan = $this->modelDonHang->addDonHang(
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
            $gioHang = $this->modelGioHang->getGioHangFromUser($user['id']);
            if ($donHangThanhToan && $gioHang) {
                $this->modelGioHang->deleteAllGioHang($id);
            }

            header("Location:" . BASE_URL);
            exit();
        }
    }





    public function huyDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $don_hang_id = $_POST['id_don_hang'] ?? null;  // Kiểm tra ID đơn hàng

            // Kiểm tra xem ID đơn hàng có hợp lệ không
            if ($don_hang_id) {
                // Đặt trạng thái là 11 (đã hủy)
                $trang_thai_id = 11;

                // Cập nhật đơn hàng
                $this->modelDonHang->updateDonHang($don_hang_id, $trang_thai_id);

                // Chuyển hướng về trang tài khoản sau khi hủy thành công
                header("Location: " . BASE_URL . "?act=tai-khoan");
                exit();
            } else {
                // Nếu không có ID đơn hàng thì xử lý lỗi
                $_SESSION['error'] = 'Không tìm thấy đơn hàng để hủy.';
                header("Location: " . BASE_URL . "?act=tai-khoan");
                exit();
            }
        }
    }
}
