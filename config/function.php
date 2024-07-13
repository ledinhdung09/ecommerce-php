<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function SendMail($to,$subject,$content,$pdfFilePath){


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
$mail->isSMTP(); //Send using SMTP
$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
$mail->SMTPAuth = true; //Enable SMTP authentication
$mail->Username = 'ledinhdung.net@gmail.com'; //SMTP username
$mail->Password = 'zqys civq xkxv cfbn'; //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('ledinhdung.net@gmail.com', 'Le Dinh Dung');
$mail->addAddress($to); //Add a recipient
// Lấy tên tệp từ đường dẫn
$filename = basename($pdfFilePath);

// Đính kèm tệp vào email
$mail->addAttachment($pdfFilePath, $filename);

//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $subject;
$mail->Body = $content;


$mail->send();
echo 'Gửi thành công';
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}

function SendMailContact($to,$subject,$content){


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
$mail->isSMTP(); //Send using SMTP
$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
$mail->SMTPAuth = true; //Enable SMTP authentication
$mail->Username = 'ledinhdung.net@gmail.com'; //SMTP username
$mail->Password = 'zqys civq xkxv cfbn'; //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom('ledinhdung.net@gmail.com', 'Le Dinh Dung');
$mail->addAddress($to); //Add a recipient

//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $subject;
$mail->Body = $content;


$mail->send();
echo 'Gửi thành công';
} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}


function ReceiveMail($to,$name,$subject,$content){

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
//Server settings
$mail->SMTPDebug = SMTP::DEBUG_OFF; //Enable verbose debug output
$mail->isSMTP(); //Send using SMTP
$mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
$mail->SMTPAuth = true; //Enable SMTP authentication
$mail->Username = 'ledinhdung.net@gmail.com'; //SMTP username
$mail->Password = 'zqys civq xkxv cfbn'; //SMTP password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
$mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//Recipients
$mail->setFrom($to, $name);
$mail->addAddress('ledinhdung.net@gmail.com'); //Add a recipient

//Content
$mail->isHTML(true); //Set email format to HTML
$mail->Subject = $subject;
$mail->Body = $content;

$mail->send();

} catch (Exception $e) {
echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}