<?php
session_start();
$is_homepage = false;

require_once("./config/Exception.php");
require_once("./config/PHPMailer.php");
require_once("./config/SMTP.php");
require_once("./config/function.php");

require_once('./db/conn.php');

if (isset($_POST['btnContact'])) {
    //lay thong tin khach hang tu form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $content = $_POST['content'];
    // khách hàng gửi phản hồi và mình nhận mail
    ReceiveMail($email,$name,'Contact', $content);

     // khách hàng gửi phản hồi và khách hàng nhận mail
     $contents = "Cảm ơn quý khách đã phản hồi.<br/>"
                ."Tên khách hàng: " .$name. "<br/>"
                ."Nội dung phản hồi: ".$content;
    SendMailContact($email,'Contact', $contents);
    header("Location: phan-hoi-thanh-cong");

}
?>