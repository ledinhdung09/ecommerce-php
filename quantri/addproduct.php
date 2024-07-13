<?php
require('../db/conn.php');
require_once('functionadmin.php');

// Lấy dữ liệu từ form
$name = $_POST['name'];
$name_no_accents = removeVietnameseAccents($name);
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name_no_accents)));
$sumary = $_POST['sumary'];
$description = $_POST['description'];
$stock = $_POST['stock'];
$giagoc = $_POST['giagoc'];
$giaban = $_POST['giaban'];
$danhmuc = $_POST['danhmuc'];
$thuonghieu = $_POST['thuonghieu'];

// Xử lý hình ảnh
$countfiles = count($_FILES['anhs']['name']);
$imgs = '';

for ($i = 0; $i < $countfiles; $i++) {
    $filename = $_FILES['anhs']['name'][$i];
    $location = "uploads/" . uniqid() . $filename;
    $extension = strtolower(pathinfo($location, PATHINFO_EXTENSION));
    $valid_extensions = array("jpg", "jpeg", "png");

    if (in_array($extension, $valid_extensions)) {
        if (move_uploaded_file($_FILES['anhs']['tmp_name'][$i], $location)) {
            $imgs .= $location . ";";
        } else {
            echo "Failed to upload file: " . $filename;
            exit();
        }
    } else {
        echo "Invalid file extension for file: " . $filename;
        exit();
    }
}

$imgs = rtrim($imgs, ';');

// Kiểm tra giá trị trước khi thực thi câu lệnh SQL
if ($name && $slug && $sumary && $description && $stock && $giagoc && $giaban && $danhmuc && $thuonghieu && $imgs) {
    // Chuẩn bị câu lệnh SQL với các biện pháp bảo mật
    $sql_str = "INSERT INTO `products` (`name`, `slug`, `description`, `summary`, `stock`, `price`, `disscounted_price`, `images`, `category_id`, `brand_id`, `status`, `created_at`, `updated_at`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Active', NOW(), NULL)";
    $stmt = $conn->prepare($sql_str);
    $stmt->bind_param('ssssisissi', $name, $slug, $description, $sumary, $stock, $giagoc, $giaban, $imgs, $danhmuc, $thuonghieu);

    if ($stmt->execute()) {
        header("Location: ./danh-sach-san-pham");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "All fields are required.";
}

$conn->close();
?>