<?php
session_start();


if (isset($_POST["btn_register"])) {
    // Lấy dữ liệu từ form
    $name = $_POST["exampleName"];
    $phone = $_POST["examplePhone"];
    $address = $_POST["exampleAddress"];
    $password = $_POST["exampleInputPassword"];
    $email = $_POST["exampleInputEmail"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Kết nối cơ sở dữ liệu
    require_once("./db/conn.php");
    
    // Chuẩn bị câu lệnh SQL với Prepared Statement
    $sql = "INSERT INTO admins (id, name, email, password, remember_token, phone, address, status, role, created_at) 
            VALUES (0, ?, ?, ?, 'null', ?, ?, 'Active', 'User', NOW())";
    
    // Sử dụng Prepared Statement
    $stmt = mysqli_stmt_init($conn);
    if (mysqli_stmt_prepare($stmt, $sql)) {
        // Bind các tham số vào câu lệnh SQL
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashed_password, $phone, $address);
        
        // Thực thi câu lệnh
        mysqli_stmt_execute($stmt);
        $errorMsgUser = "Đăng ký thành công";
        $errorAlertUser = "alert-success";
        header("Location: dang-nhap");
    } else {
        // Lỗi trong quá trình chuẩn bị câu lệnh
        die('Prepare failed: ' . htmlspecialchars(mysqli_error($conn)));
    }
    
    // Đóng kết nối
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    // Nếu không có dữ liệu post, hiển thị form đăng nhập
    require_once("components/registerform.php");
}
?>