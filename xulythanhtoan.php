<?php
session_start();
$is_homepage = false;
require_once("./config/Exception.php");
require_once("./config/PHPMailer.php");
require_once("./config/SMTP.php");
require_once("./config/function.php");
require_once("./config/pdf.php");
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

if (!isset($_SESSION['user'])) {
    header('dang-nhap');
}

require_once('./db/conn.php');

if (isset($_POST['btnDathang'])) {
    //lay thong tin khach hang tu form
    $user = $_SESSION['user'];
    $firstname = $_POST['firstname'];
    $us_ID = $user['id'];
    $phone = $_POST['sdt'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $totalMoney = $_POST['totalMoney'];
    //tao du lieu cho order
    $sqli = "insert into orders values (0,'$us_ID', '$firstname', '$address', '$phone', '$email', 'Processing', now(), now())";
   
    //echo $sqli;
    //exit; // mysqli_query($conn, $sqli);
    //lay id vua duoc them vao 
    if (mysqli_query($conn, $sqli)) {
        $last_order_id = mysqli_insert_id($conn);
        //sau do them vao orer detail
        foreach ($cart as $item) {
            $masp = $item['id'];
            $disscounted_price = $item['disscounted_price'];
            $qty = $item['qty'];
            $total = $item['qty'] * $item['disscounted_price'];
            $sqli2 = "insert into order_details values 
            (0, $last_order_id, $masp,  $disscounted_price, $qty, $total, now(), now())";
            // echo $sqli2, exit;
            mysqli_query($conn, $sqli2);
        }
    }
    $content = "Cảm ơn quý khách đã đặt hàng của cửa hàng.<br/>"
                ."Tên khách hàng: " . $firstname . "<br/>"
                ."Số điện thoại: " . $phone. "<br/>"
                ."Địa chỉ giao hàng: " . $address. "<br/>"
                ."<strong?>Tổng số tiền thanh toán: " . number_format($totalMoney, 0, '', '.') .
"VNĐ"."</strong>"."<br />"
."Vui lòng xem chi tiết đơn đặt hàng của bạn trong bản PDF đính kèm.";

// Gửi thông báo đơn hàng cho khách
$pdfFilePath = generateOrderPDF($firstname,$phone, $email,$address,$totalMoney,$last_order_id);
SendMail($email,'Xac nhan don hang', $content, $pdfFilePath);

//xoa cart
unset($_SESSION["cart"]);
header("Location: cam-on");

}
?>