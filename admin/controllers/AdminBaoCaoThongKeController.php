<?php

class AdminBaoCaoThongKeController
{
    public $modelSanPham;
    public $modelDonHang;

    public function __construct()
    {
        $this->modelSanPham = new AdminSanPham();
        $this->modelDonHang = new AdminDonHang(); // Instantiate DonHang model
    }

    public function home()
    {
        $listSanPham = $this->modelSanPham->getAllSanPham();

        // Lấy thống kê đơn hàng từ thứ Hai đến hiện tại
        $donHangStats = $this->modelDonHang->getDonHangTheoTrangThaiTuThuHaiDenHienTai();

        // Debugging output (bạn có thể bỏ comment khi cần thiết)
        // if (empty($donHangStats)) {
        //     echo 'Không tìm thấy đơn hàng trong thời gian này.';
        // } else {
        //     print_r($donHangStats); // Temporarily print the result
        // }

        require_once './views/home.php'; // Gọi view home.php
    }


}

