<?php

// require kết nối đến cơ sở dữ liệu
require('../db/conn.php');

// Lấy dữ liệu từ form
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$status = $_POST['status'];
$type = $_POST['type'];


// Mã hóa mật khẩu trước khi lưu vào cơ sở dữ liệu
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Chuẩn bị câu lệnh SQL
$stmt = $conn->prepare("INSERT INTO admins (name, email, password, phone, address, status, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, NOW())");

// Kiểm tra xem câu lệnh chuẩn bị có thành công không
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

// Bind các biến vào câu lệnh SQL
$stmt->bind_param("sssssss", $name, $email, $hashed_password, $phone, $address, $status, $type);

// Thực thi câu lệnh SQL
$stmt->execute();

// Kiểm tra xem câu lệnh có thực thi thành công không
if ($stmt->error) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

// Đóng câu lệnh
$stmt->close();

// Đóng kết nối
$conn->close();

// Chuyển hướng về trang danh sách tài khoản
header("Location: danh-sach-tai-khoan");
exit;


// Chuyển hướng về trang danh sách tài khoản
header("Location: danh-sach-tai-khoan");
exit;
?>