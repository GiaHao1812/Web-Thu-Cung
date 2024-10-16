<?php

class AdminDonHang
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }
    public function getAllDonHang()
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai 
            FROM don_hangs 
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            ORDER BY don_hangs.ngay_dat DESC ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getAllTrangThaiDonHang()
    {
        try {
            $sql = "SELECT * FROM trang_thai_don_hangs";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getDetailDonHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, 
            trang_thai_don_hangs.ten_trang_thai ,
            tai_khoans.ho_ten, tai_khoans.email, tai_khoans.so_dien_thoai,
            phuong_thuc_thanh_toans.ten_phuong_thuc
            
            FROM don_hangs 
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id 
            INNER JOIN tai_khoans ON don_hangs.tai_khoan_id = tai_khoans.id 
            INNER JOIN phuong_thuc_thanh_toans ON don_hangs.phuong_thuc_thanh_toan_id = phuong_thuc_thanh_toans.id 
            WHERE don_hangs.id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getListSpDonHang($id)
    {
        try {
            $sql = "SELECT san_phams.ten_san_pham
            FROM chi_tiet_don_hangs
            INNER JOIN san_phams ON chi_tiet_don_hangs.don_hang_id = san_phams.id
            WHERE chi_tiet_don_hangs.don_hang_id = :id";


            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    public function updateDonHang(
        $id,
        $trang_thai_id
    ) {
        try {
            $sql = "UPDATE don_hangs
                    SET 
                        trang_thai_id = :trang_thai_id
                    WHERE id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':trang_thai_id' => $trang_thai_id,
                ':id' => $id
            ]);
            return true;
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }


    public function getDonHangFromKhachHang($id)
    {
        try {
            $sql = "SELECT don_hangs.*, trang_thai_don_hangs.ten_trang_thai 
            FROM don_hangs 
            INNER JOIN trang_thai_don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id

            WHERE don_hangs.tai_khoan_id = :id
            ORDER BY don_hangs.ngay_dat DESC 

            WHERE don_hangs.tai_khoan_id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    
    // public function getDonHangLast7Days()
    // {
    //     try {
    //         $sql = "SELECT COUNT(don_hangs.id) as total_don_hang, 
    //         COALESCE(SUM(chi_tiet_don_hangs.so_luong * chi_tiet_don_hangs.don_gia), 0) as tong_gia_tri 
    //         FROM don_hangs
    //         LEFT JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
    //         WHERE don_hangs.ngay_dat >= DATE(NOW()) - INTERVAL 7 DAY";



    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->execute();

    //         return $stmt->fetch(); // Return single row
    //     } catch (\Exception $e) {
    //         echo 'Lỗi: ' . $e->getMessage();
    //     }
    // }
//     public function getTotalDonHangById($id)
// {
//     try {
//         $sql = "SELECT don_hangs.*, 
//                        SUM(chi_tiet_don_hangs.gia * chi_tiet_don_hangs.so_luong) as tong_gia_tri
//                 FROM don_hangs
//                 LEFT JOIN chi_tiet_don_hangs ON don_hangs.id = chi_tiet_don_hangs.don_hang_id
//                 WHERE don_hangs.id = :id
//                 GROUP BY don_hangs.id";

    //         $stmt = $this->conn->prepare($sql);
//         $stmt->execute([':id' => $id]);

    //         return $stmt->fetch();
//     } catch (\Exception $e) {
//         echo 'Lỗi: ' . $e->getMessage();
//     }
// }
// public function getTongDonHangTheoNgay($date)
// {
//     try {
//         $sql = "SELECT COUNT(*) AS total_orders 
//                 FROM don_hangs 
//                 WHERE DATE(ngay_dat) = :date";

    //         $stmt = $this->conn->prepare($sql);
//         $stmt->execute([':date' => $date]);

    //         return $stmt->fetch();
//     } catch (\Exception $e) {
//         echo 'Lỗi: ' . $e->getMessage();
//     }
// }
    public function getDonHangTheoTrangThaiTuThuHaiDenHienTai()
    {
        try {
            $sql = "SELECT 
                trang_thai_don_hangs.id AS trang_thai_id, 
                trang_thai_don_hangs.ten_trang_thai, 
                COUNT(don_hangs.id) AS so_luong_don_hang,
                DATE(don_hangs.ngay_dat) AS ngay_dat
            FROM 
                trang_thai_don_hangs
            LEFT JOIN 
                don_hangs ON don_hangs.trang_thai_id = trang_thai_don_hangs.id
            WHERE 
                trang_thai_don_hangs.id IN (1, 6, 9, 10, 11) AND
                don_hangs.ngay_dat >= DATE_SUB(CURDATE(), INTERVAL WEEKDAY(CURDATE()) DAY) 
                AND don_hangs.ngay_dat <= CURDATE()  -- Tính từ thứ 2 đến nay
                
            GROUP BY 
                trang_thai_don_hangs.id, DATE(don_hangs.ngay_dat)
            ORDER BY 
                ngay_dat DESC, trang_thai_don_hangs.id";  // Sắp xếp theo ngày và trạng thái

            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return [];  // Trả về mảng rỗng trong trường hợp có lỗi
        }
    }


}
