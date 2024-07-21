<?php
require_once("./db/conn.php");
require_once("./config/PHPMailer.php");
require_once("./config/SMTP.php");
require_once("./config/function.php");

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["email"])) {
        $email = $_GET["email"];
       

        // Kiểm tra sự tồn tại của email trong cơ sở dữ liệu
        $sql = "SELECT email FROM admins WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if (mysqli_stmt_num_rows($stmt) > 0) {
                // Email đã tồn tại
                if ($otp) {
                    $contents = "Mã OTP của quý khách là: " . $otp;
                    SendMailContact($email, 'OTP Verification', $contents);
                }
                echo "exists";
            } else {
                // Email chưa tồn tại
                echo "not_exists";
                // Gửi OTP qua email

            }

            mysqli_stmt_close($stmt);
        } else {
            echo "error";
        }

        mysqli_close($conn);
    } else {
        echo "no_email";
    }
}