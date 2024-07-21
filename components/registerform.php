<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="shortcut icon" href="./images/logo_icon.png" type="image/x-icon" />
    <meta name="author" content="">

    <title>Đăng ký - Cửa hàng rau củ quả</title>

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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="pl-5 pr-5 pt-4 pb-4">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Đăng ký tài khoản!</h1>
                            </div>
                            <form class="user" name="registerForm" id="registerForm" method="post"
                                onsubmit="return validateForm()">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="exampleName"
                                            placeholder="Họ và tên">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="examplePhone"
                                            placeholder="Số điện thoại">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="exampleInputEmail"
                                        placeholder="Email Address">
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="exampleAddress"
                                            placeholder="Địa chỉ">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" name="exampleOTP"
                                            placeholder="Mã OTP">

                                    </div>
                                    <div class="col-sm-3">
                                        <a class="form-control btn btn-warning" name="btn_OTP"
                                            style="height:100% ;border-radius: 10rem;align-content:center;"
                                            onclick="checkEmail()">
                                            Gửi OTP
                                        </a>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <p class=' txt-register p-1 text-center alert-success'>
                                        Vui lòng điền đẩy đủ thông tin
                                    </p>
                                </div>
                                <button class="btn btn-success btn-user btn-block" type="submit" name="btn_register"
                                    style="font-size: 20px;">
                                    Đăng ký
                                </button>

                            </form>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <a class="small" href="quen-mat-khau">Quên mật khẩu</a>
                                </div>
                                <div class="col-sm-6 text-right">
                                    <a class="small" href="dang-nhap">Bạn đã có tài khoản? Đăng nhập!</a>
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
        let otp = Math.floor(Math.random() * 10000);
        otp = otp.toString().padStart(4, '0');
        return otp;
    }

    function checkEmail() {
        randomOTP = generateRandomOTP();
        var email = document.forms["registerForm"]["exampleInputEmail"].value;
        var txt = document.querySelector(".txt-register");

        if (email === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập Email hợp lệ.";
            return;
        } else {
            // Gửi OTP đến email
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "check_email.php?email=" + encodeURIComponent(email) + "&otp=" + encodeURIComponent(
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

    function validateForm() {
        var firstname = document.forms["registerForm"]["exampleName"].value;
        var phone = document.forms["registerForm"]["examplePhone"].value;
        var address = document.forms["registerForm"]["exampleAddress"].value;
        var pass = document.forms["registerForm"]["exampleInputPassword"].value;
        var pass1 = document.forms["registerForm"]["exampleRepeatPassword"].value;
        var email = document.forms["registerForm"]["exampleInputEmail"].value;
        var otp = document.forms["registerForm"]["exampleOTP"].value;
        var txt = document.querySelector(".txt-register");

        if (firstname === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập Họ & tên!";
            return false;
        }
        if (phone === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập số điện thoại!";
            return false;
        }
        if (email === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập email!";
            return false;
        }
        if (address === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập địa chỉ!";
            return false;
        }
        if (pass === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập mật khẩu!";
            return false;
        }
        if (pass1 === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập lại mật khẩu!";
            return false;
        }
        if (pass !== pass1) {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng khớp mật khẩu!";
            return false;
        }
        if (otp === "") {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập OTP!";
            return false;
        }
        if (otp != randomOTP) {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "Vui lòng nhập đúng OTP!";
            return false;
        }
        if (otp !== randomOTP) {
            txt.classList.add("alert-danger");
            txt.classList.remove("alert-success");
            txt.innerText = "OTP không khớp!";
            return false;
        }

        txt.classList.remove("alert-danger");
        txt.classList.add("alert-success");
        return true;
    }
    </script>

</body>

</html>