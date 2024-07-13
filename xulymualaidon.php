<?php
session_start();
$is_homepage = false;


require_once('./db/conn.php');

if (isset($_POST['btnMuaLai'])) {
    //lay thong tin khach hang tu form
    $order_id = $_POST['btnMuaLai'];
    $sql_str = "UPDATE `orders` SET `status` = 'Processing' WHERE `id` = $order_id";
    mysqli_query($conn,$sql_str);
    header("Location: lich-su-mua-hang");

}

?>