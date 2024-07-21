<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Ogani Template">
    <link rel="shortcut icon" href="./images/logo_icon.png" type="image/x-icon" />
    <meta name="keywords" content="Ogani, unica, creative, html">

    <title>Đăng nhập - Cửa hàng rau củ quả</title>

    <!-- Custom fonts for this template-->
    <link href="./quantri/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./quantri/css/sb-admin-2.min.css" rel="stylesheet">

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
                            <div class="col-lg-8  offset-lg-2">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Đăng nhập</h1>

                                    </div>
                                    <form class="user" name="loginForm" method="post" onsubmit="return validateForm()">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-user" name="exampleOTP" placeholder="Mã OTP">

                                            </div>
                                            <div class="col-sm-3">
                                                <a class="form-control btn btn-warning" name="btn_OTP" style="height:100% ;border-radius: 10rem;align-content: center;" onclick="checkEmail()">
                                                    Gửi OTP
                                                </a>
                                            </div>

                                            <div class="col-sm-5 mb-3 mb-sm-0 text-right" style="align-content: end;">
                                                <a class="small" href="quen-mat-khau">Quên mật khẩu?</a>
                                            </div>


                                        </div>
                                        <div class="form-group">
                                            <?php echo "<p class=' txt_login p-1 text-center $errorAlertUser'>$errorMsgUser</p>" ?>
                                        </div>
                                        <button name="btSubmitUser" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <hr>
                                        <a href="#" onclick="alert('Chức năng đang được phát triển ...')" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="#" onclick="alert('Chức năng đang được phát triển ...')" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a>
                                        <div class="form-group mt-2 d-flex justify-content-end">
                                            <a href="dang-ky">Tạo tài khoản</a>
                                            <a href="trang-chu" class="ml-2 mr-2">Trang chủ</a>
                                        </div>
                                    </form>

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
            var email = document.forms["loginForm"]["exampleInputEmail"].value;
            var txt = document.querySelector(".txt_login");

            if (email === "") {
                txt.classList.add("alert-danger");
                txt.classList.remove("alert-success");
                txt.innerText = "Vui lòng nhập Email hợp lệ.";
                return;
            } else {
                // Gửi OTP đến email
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "check_email_login.php?email=" + encodeURIComponent(email) + "&otp=" + encodeURIComponent(
                        randomOTP),
                    true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response != "not_exists") {
                            txt.classList.add("alert-success");
                            txt.classList.remove("alert-danger");
                            txt.innerText = "Đã gửi OTP vui lòng kiểm tra email!";
                        } else if (response === "not_exists") {
                            txt.classList.remove("alert-success");
                            txt.classList.add("alert-danger");
                            txt.innerText = "Email chưa được đăng ký tài khoản.";
                        }
                    }
                };
                xhr.send();
            }
        }

        function validateForm() {
            var email = document.forms["loginForm"]["email"].value;
            var pass = document.forms["loginForm"]["password"].value;
            var otp = document.forms["loginForm"]["exampleOTP"].value;
            console.log(randomOTP)
            var txt = document.querySelector(".txt_login");

            if (email === "") {
                txt.classList.add("alert-danger");
                txt.classList.remove("alert-success");
                txt.innerText = "Vui lòng nhập Email!";
                return false;
            }
            if (pass === "") {
                txt.classList.add("alert-danger");
                txt.classList.remove("alert-success");
                txt.innerText = "Vui lòng nhập Pass!";
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

            txt.classList.remove("alert-danger");
            txt.classList.add("alert-success");
            return true;
        }
    </script>
</body>

</html>