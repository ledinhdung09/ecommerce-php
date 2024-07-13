<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $danhmuc = $_POST['danhmuc'];
    $tukhoa = $_POST['tukhoa'];

    // Chuyển hướng đến URL thân thiện
    header("Location: tim-kiem/danh-muc-$danhmuc/tu-khoa-$tukhoa");
    exit();
}
?>