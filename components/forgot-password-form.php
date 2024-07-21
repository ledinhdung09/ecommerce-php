<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="./images/logo_icon.png" type="image/x-icon" />
    <title>Quên mật khẩu - Cửa hàng rau củ quả</title>

    <!-- Custom fonts for this template-->
    <link href="./quantri/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./quantri/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Quên mật khẩu?</h1>
                                        <p class="mb-4">Chúng tôi hiểu rồi, mọi thứ sẽ ổn thôi. Chỉ cần nhập địa chỉ
                                            email của bạn bên dưới và chúng tôi sẽ gửi cho bạn một mật khẩu mới qua địa
                                            chỉ Email của bạn!</p>
                                    </div>
                                    <form class="user" name="forgetPasswordForm">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group row">

                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" name="captcha"
                                                    placeholder="Captcha">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" disabled class="form-control form-control-user"
                                                    name="captchaval" value="">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <p class=' txt_forget_password p-1 text-center alert-success'>
                                                Vui lòng điền đẩy đủ thông tin
                                            </p>
                                        </div>
                                        <a onclick="checkEmail()" class="btn btn-success btn-user btn-block">
                                            Đặt lại mật khẩu
                                        </a>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="dang-ky">Tạo tài khoản!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="dang-nhap">Bạn đã có tài khoản? Đăng nhập!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="./quantri/vendor/jquery/jquery.min.js"></script>
    <script src="./quantri/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="./quantri/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="./quantri/js/sb-admin-2.min.js"></script>
    <script>
    let randomOTP = '';

    function generateRandomOTP() {
        let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let otp = '';
        for (let i = 0; i < 6; i++) {
            otp += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        return otp;
    }
    randomOTP = generateRandomOTP();
    var captchaval = document.forms["forgetPasswordForm"]["captchaval"].value = randomOTP;

    function checkEmail() {
        var email = document.forms["forgetPasswordForm"]["email"].value;
        var captcha = document.forms["forgetPasswordForm"]["captcha"].value;


        var txt = document.querySelector(".txt_forget_password");

        if (email === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập Email.";
            return;
        } else if (captcha === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập captcha.";
            return;
        } else if (captcha != captchaval) {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập đúng captcha.";
            return;

        } else {
            // Gửi OTP đến email
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "check_email_forget_password.php?email=" + encodeURIComponent(email) + "&otp=" +
                encodeURIComponent(
                    randomOTP),
                true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === "exists") {
                        txt.classList.add("alert-danger");
                        txt.classList.remove("alert-success");
                        txt.innerText = "Email đã tồn tại, vui lòng sử dụng email khác.";
                    } else if (response != "exists") {
                        txt.classList.remove("alert-danger");
                        txt.classList.add("alert-success");
                        txt.innerText = "Email hợp lệ, mã OTP đã được gửi.";
                    }
                }
            };
            xhr.send();
        }
    }
    </script>

</body>

</html>