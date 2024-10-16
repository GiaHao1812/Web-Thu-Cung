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
        $don_hang_id = $_GET['don_hang_id'];

        // Lấy thông tin đơn hàng ở bản don_hangs
        $donHang = $this->modelDonHang->getDetailDonHang($don_hang_id);

        // Lấy danh sách sản phẩm của đơn hàng ở bảng chi_tiet_don_hangs

        $sanPhamDonHang = $this->modelDonHang->getListSpDonHang($don_hang_id);

        $listTrangThaiDonHang = $this->modelDonHang->getAllTrangThaiDonHang();

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
            header("Location: " . BASE_URL_ADMIN . "?act=don-hang");
            exit();
        }
    }

    public function postEditDonHang()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $don_hang_id = $_POST['don_hang_id'] ?? '';
            $trang_thai_id = $_POST['trang_thai_id'] ?? '';

            // Kiểm tra lỗi
            $error = [];
            if (empty($trang_thai_id)) {
                $error['trang_thai_id'] = 'Trạng thái đơn hàng phải chọn';
            }

            $_SESSION['error'] = $error;

            // Nếu không có lỗi thì tiến hành cập nhật
            if (empty($error)) {
                $this->modelDonHang->updateDonHang($don_hang_id, $trang_thai_id);
                header("Location: " . BASE_URL_ADMIN . "?act=don-hang");
                exit();
            } else {
                $_SESSION['flash'] = true;
                header("Location: " . BASE_URL_ADMIN . "?act=sua-don-hang&id_don_hang=" . $don_hang_id);
                exit();
            }
        }
    }
}
