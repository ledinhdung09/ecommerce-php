<?php

require('../db/conn.php');
require_once('functionadmin.php');

// Lấy dữ liệu từ form
$name = $_POST['name'];
$name_no_accents = removeVietnameseAccents($name);
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name_no_accents)));

// Câu lệnh thêm vào bảng
$sql_str = "INSERT INTO `categories` (`name`, `slug`, `status`, `created_at`) VALUES 
    ('$name', 
    '$slug', 
    'Active', 
    NOW())"; // Thêm dấu ngoặc đơn đóng ở đây

// Thực thi câu lệnh
if (mysqli_query($conn, $sql_str)) {
    // Trở về trang listcats.php nếu thành công
    header("Location: danh-sach-danh-muc-san-pham");
    exit(); // Dừng script để đảm bảo chuyển hướng
} else {
    // Hiển thị lỗi nếu câu lệnh thất bại
    echo "Error: " . $sql_str . "<br>" . mysqli_error($conn);
}

// Đóng kết nối
mysqli_close($conn);
?>