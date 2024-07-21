<?php
session_start();
$errorMsg = "Mời bạn đăng nhập";

$errorAlert= "alert-success";

if (isset($_POST["btSubmit"])) {
    // Lấy dữ liệu từ form
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    // Kết nối csdl
    require_once("../db/conn.php");
    
    // Chuẩn bị câu lệnh SQL với Prepared Statement
    $sql = "SELECT * FROM admins WHERE email = ? and role = 'Admin'";
    
    // Sử dụng Prepared Statement
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind tham số vào câu lệnh SQL
        mysqli_stmt_bind_param($stmt, "s", $email);
        
        // Thực thi câu lệnh
        mysqli_stmt_execute($stmt);
        
        // Lấy kết quả
        $result = mysqli_stmt_get_result($stmt);
        
        // Kiểm tra số dòng trả về
        if (mysqli_num_rows($result) > 0) {
            // Lấy dữ liệu người dùng từ kết quả
            $row = mysqli_fetch_assoc($result);
            
            // Kiểm tra mật khẩu với password_verify
            if (password_verify($password, $row['password'])) {
                // Đăng nhập thành công, lưu thông tin người dùng vào session
                $_SESSION['admin'] = $row;
                
                // Chuyển hướng đến trang quản trị
                header("Location: trang-chu-admin");
                exit;
            } else {
                // Mật khẩu không đúng
                $errorAlert= "alert-danger";
                $errorMsg = "Sai mật khẩu";
                require_once("includes/loginform.php");
            }
        } else {
            // Không tìm thấy thông tin tài khoản
            $errorAlert= "alert-danger";
            $errorMsg = "Không tìm thấy thông tin tài khoản trong hệ thống";
            require_once("includes/loginform.php");
        }
    } else {
        // Lỗi trong quá trình chuẩn bị câu lệnh
        die('Prepare failed: ' . htmlspecialchars(mysqli_error($conn)));
    }
    
    // Đóng kết nối
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Nếu không có dữ liệu post, hiển thị form đăng nhập
    require_once("includes/loginform.php");
}
?>