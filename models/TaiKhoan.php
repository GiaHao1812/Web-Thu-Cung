<?php

class TaiKhoan
{
    public $conn;

    public function __construct()
    {
        $this->conn = connectDB();
    }

    public function checkLogin($email, $mat_khau)
    {
        try {
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user && password_verify($mat_khau, $user['mat_khau'])) {

                if ($user['chuc_vu_id'] == 2) {
                    if ($user['trang_thai'] == 1) {
                        //sửa  return $user['email']-> return $user thay vì trả lại 1 chuổi email thì trả lại 1 đối tượng user
                        return $user; // Trường Hợp đăng nhập thành công
                    } else {
                        return "Tài Khoản Bị Cấm";
                    }
                } else {
                    return "Tài Khoản Không Có Quyền Đăng Nhập";
                }
            } else {
                return "Bạn Nhập Sai Thông Tin Email Hoặc Mật Khẩu";
            }
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
            return false;
        }
    }
    public function getTaiKhoanFromEmail($email)
    {
        try {
            $sql = "SELECT * FROM tai_khoans WHERE email = :email";

            $stmt = $this->conn->prepare($sql);

            $stmt->execute([
                ':email' => $email
            ]);

            return $stmt->fetch();
        } catch (\Exception $e) {
            echo 'Lỗi' . $e->getMessage();
        }
    }
 
  



    public function registerUser($ho_ten, $email, $mat_khau)
    {
 
        try {
            // Kiểm tra xem email đã tồn tại trong cơ sở dữ liệu chưa
            $sql = 'SELECT * FROM tai_khoans WHERE email = :email';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
                return "Email này đã được sử dụng."; // Trường hợp email đã tồn tại
            } else {
                // Mã hóa mật khẩu trước khi lưu
                $hashedPassword = password_hash($mat_khau, PASSWORD_BCRYPT);
 


 
                // Tạo tài khoản mới
                $sql = 'INSERT INTO tai_khoans (ho_ten, email, mat_khau, chuc_vu_id, trang_thai) 
                    VALUES (:ho_ten, :email, :mat_khau, :chuc_vu_id, :trang_thai)';
                $stmt = $this->conn->prepare($sql);
 


 
                // Chức vụ là 2 (khách hàng) và trạng thái là 1 (kích hoạt)
                $stmt->execute([
                    ':ho_ten' => $ho_ten,
                    ':email' => $email,
                    ':mat_khau' => $hashedPassword,
                    ':chuc_vu_id' => 2,
                    ':trang_thai' => 1
                ]);
 


 
                header("Location:" . BASE_URL . '?act=login');
                return "Đăng kí thành công";
                // Trả về thông tin người dùng sau khi đăng ký thành công
            }
        } catch (\Exception $e) {
            echo 'Lỗi: ' . $e->getMessage();
            return false;
        }
    }
}
