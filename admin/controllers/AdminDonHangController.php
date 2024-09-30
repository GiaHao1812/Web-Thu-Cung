<?php

class AdminDonHangController
{
    public $modelDonHang;

    public function __construct()
    {
        $this->modelDonHang = new AdminDonHang();
    }

    public function danhSachDonHang()
    {
        $listDonHang = $this->modelDonHang->getAllDonHang();

        require_once './views/donhang/listDonHang.php';
    }

    public function detailDonHang()
    {
        $don_hang_id = $_GET['id_don_hang'];

        //  Lấy thông tin đơn hàng từ bảng don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        //Lấy danh sách đã đặt của đơn hàng  ỏ bảng chi_tiet_don_hangs
        $sanPhamDonHang = $this->modelDonHang->getListSanPhamDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

        // var_dump($sanPhamDonHang);die;
        require_once './views/donhang/detailDonHang.php';

    }

    //////////////////
    //SỬA Đơn Hàng//
    ////////////////


    public function formEditDonHang()
    {
        $id = $_GET['id_don_hang'];
        $donHang = $this->modelDonHang->getDetailDonHang($id);
        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();
        if ($donHang) {
            require_once './views/donhang/editDonHang.php';
            deleteSessionError();
        } else {
            header("Location:" . BASE_URL_ADMIN) . '?act=don-hang';
            exit();
        }

    }

    // public function formEditDonHang()
    // {

    //     // Lấy ra thông tin của danh mục cần sửa
    //     $id = $_GET['id_san_pham'];
    //     $sanPham = $this->modelSanPham->getDetailSanPham($id);
    //     $listAnhSanPham = $this->modelSanPham->getListAnhSanPham($id);
    //     $listDanhMuc = $this->modelDanhMuc->getAllDanhMuc();
    //     if ($sanPham) {
    //         require_once './views/sanpham/editSanPham.php';
    //         deleteSessionError();
    //     } else {
    //         header("Location: " . BASE_URL_ADMIN . "?act=san-pham");
    //         exit();
    //     }


    //     //Hàm Này Dùng để hiện thị form nhập    
    // }
    public function postEditDonHang()
    {


        //Hàm Này Dùng Xử lý thêm dữ liệu

        // Kiểm tra xem dữ liệu có phải được submit lên không

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy ra dữ liệu 
            // Lấy ra dữ liêu của sản phẩm
            $don_hang_id = $_POST['don_hang_id'] ?? '';




            $ten_nguoi_nhan = $_POST['ten_nguoi_nhan'] ?? '';
            $sdt_nguoi_nhan = $_POST['sdt_nguoi_nhan'] ?? '';
            $email_nguoi_nhan = $_POST['email_nguoi_nhan'] ?? '';
            $dia_chi_nguoi_nhan = $_POST['dia_chi_nguoi_nhan'] ?? '';
            $ghi_chu = $_POST['ghi_chu'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';



            // Tạo 1 mảng trống để chứa dữ liệu
            $error = [];
            if (empty($ten_nguoi_nhan)) {
                $error['ten_nguoi_nhan'] = 'Tên người nhận không được để trống';
            }
            if (empty($sdt_nguoi_nhan)) {
                $error['sdt_nguoi_nhan'] = 'SDT người nhận không được để trống';
            }
            if (empty($email_nguoi_nhan)) {
                $error['email_nguoi_nhan'] = 'Email người nhận không được để trống';
            }
            if (empty($dia_chi_nguoi_nhan)) {
                $error['dia_chi_nguoi_nhan'] = 'Địa chỉ người nhận không được để trống';
            }
            if (empty($trang_thai_id)) {
                $error['trang_thai_id'] = 'Trạng thái đơn hàng  ';
            }


            $_SESSION['error'] = $error;



            // Nếu không có lỗi thì tiến hành thêm sản phẩm
            if (empty($error)) {
                // Nếu không có lỗi thì tiến hành sửa 
                // var_dump('okkk');
                $abc = $this->modelDonHang->updateDonHang(
                    $don_hang_id,
                    $ten_nguoi_nhan,
                    $sdt_nguoi_nhan,
                    $email_nguoi_nhan,
                    $dia_chi_nguoi_nhan,
                    $ghi_chu,
                    $trang_thai_id,

                );
                // var_dump($abc);
                // die;
                header("Location: " . BASE_URL_ADMIN . "?act=don-hang");
                exit();
            } else {
                //Trả về form
                // Đặt chỉ thị xóa session sau khi hiển thị form 

                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . "?act=form-sua-don-hang&id_don_hang=" . $don_hang_id);
                exit();
            }
        }
    }

}
