<?php
class SanPham
{
    public $conn; // Khai báo phương thức
    public function __construct()
    {
        $this->conn = connectDB();
    }
    //Viết hàm lấy toàn bộ danh sách sản phẩm
    public function getAllSanPham(): array
    {
        try {
            $sql = "SELECT san_phams.* , danh_mucs.ten_danh_muc
            FROM san_phams
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi " . $e->getMessage();
        }
    }
    public function getSanPhamByTaiKhoan($tai_khoan_id): array
    {
        try {
            $sql = "SELECT san_phams.* , danh_mucs.ten_danh_muc
                FROM san_phams
                INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
                INNER JOIN chi_tiet_don_hangs ON san_phams.id = chi_tiet_don_hangs.san_pham_id
                INNER JOIN don_hangs ON chi_tiet_don_hangs.don_hang_id = don_hangs.id
                WHERE don_hangs.tai_khoan_id = :tai_khoan_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':tai_khoan_id', $tai_khoan_id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi " . $e->getMessage();
        }
    }

    public function getAllDanhMuc()
    {
        try {
            $sql = "SELECT * FROM danh_mucs"; // Truy vấn lấy tất cả danh mục
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về mảng các danh mục
        } catch (Exception $e) {
            echo "Lỗi: " . $e->getMessage();
        }
    }

    public function getAllSanPhamToDanhMuc($id)
    {
        try {
            // Đảm bảo rằng $id được truyền vào là một số nguyên
            $id = (int)$id;

            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc
        FROM san_phams
        INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id
        WHERE san_phams.danh_muc_id = :id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (Exception $e) {
            echo "Lỗi " . $e->getMessage();
        }
    }


    public function getDetailSanPham($id)
    {
        try {
            $sql = "SELECT san_phams.*, danh_mucs.ten_danh_muc FROM san_phams INNER JOIN danh_mucs ON san_phams.danh_muc_id = danh_mucs.id WHERE san_phams.id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    public function getListAnhSanPham($id)
    {
        try {
            $sql = "SELECT * FROM hinh_anh_san_phams WHERE san_pham_id = :id";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
    public function getBinhLuanFromSanPham($id)
    {
        try {
            $sql = "SELECT binh_luans.*, tai_khoans.ho_ten , tai_khoans.anh_dai_dien
            FROM binh_luans 
            INNER JOIN tai_khoans ON binh_luans.tai_khoan_id = tai_khoans.id
            WHERE binh_luans.san_pham_id = :id
            ";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([':id' => $id]);

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }

    // public function updateBinhLuan($id, $noi_dung)
    // {
    //     try {
    //         $sql = "UPDATE binh_luans SET noi_dung= :noi_dung WHERE id = :id";

    //         $stmt = $this->conn->prepare($sql);

    //         $stmt->execute([
    //             ':noi_dung' => $noi_dung,
    //             ':id' => $id
    //         ]);

    //         return true;
    //     } catch (\Exception $e) {
    //         echo 'Lỗi' . $e->getMessage();
    //     }
    // }

    public function getListSanPhamDanhMuc($danh_muc_id)
    {
        try {
            $sql = 'SELECT san_phams.* , danh_mucs.ten_danh_muc
            FROM san_phams 
            INNER JOIN danh_mucs on san_phams.danh_muc_id = danh_mucs.id
            WHERE san_phams.danh_muc_id = ' . $danh_muc_id;

            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            return $stmt->fetchAll();
        } catch (\Exception $e) {
            echo "Lỗi " . $e->getMessage();
        }
    }
}
