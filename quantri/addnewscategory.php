<?php

// echo "xin chao";


require('../db/conn.php');
require_once('functionadmin.php');

//lay du lieu tu form
$name = $_POST['name'];
$name_no_accents = removeVietnameseAccents($name);
$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name_no_accents)));


// cau lenh them vao bang
$sql_str = "INSERT INTO `newscategories` (`name`, `slug`,  `status`,`created_at`) VALUES 
    ( '$name', 
    '$slug', 
    'Active',
    now())";

// echo $sql_str; exit;

//thuc thi cau lenh
mysqli_query($conn, $sql_str);

//tro ve trang 
header("location: danh-sach-danh-muc-tin-tuc");
?>