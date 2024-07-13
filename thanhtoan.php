<?php

session_start();
$is_homepage = false;
require_once('./db/conn.php');
if (!isset($_SESSION['user'])) {
    header('Location: dang-nhap');
    exit;
}




require_once('components/header.php');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">

        <div class="checkout__form">
            <h4>Thông tin Khách hàng</h4>
            <form name="checkoutForm" action="xulythanhtoan.php" method="post" onsubmit="return validateForm()">
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ & tên<span>*</span></p>
                                    <input type="text" value="<?php $user = $_SESSION['user']; echo $user['name']?>"
                                        name='firstname'>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Địa chỉ nhận hàng:<span>*</span></p>
                                    <input type="text" value="<?php $user = $_SESSION['user']; echo $user['address']?>"
                                        class="checkout__input__add" name="address">
                                </div>
                            </div>
                        </div>




                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại:<span>*</span></p>
                                    <input type="text" value="<?php $user = $_SESSION['user']; echo $user['phone']?>"
                                        name="sdt">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email:<span>*</span></p>
                                    <input type="email" value="<?php $user = $_SESSION['user']; echo $user['email']?>"
                                        name="email">
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                            <ul>
                                <?php
                                $cart = [];
                                if (isset($_SESSION['cart'])) {
                                    $cart = $_SESSION['cart'];
                                }
                                // var_dump($cart);die();
                                $count = 0; //số thứ tự
                                $total = 0;
                                foreach ($cart as $item) {
                                    $total += $item['qty'] * $item['disscounted_price'];
                                    ?>
                                <li>
                                    <?= $item['name'] ?> <span>
                                        <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                    </span>
                                </li>
                                <?php } ?>

                            </ul>
                            <div class="checkout__order__total">Tổng tiền: <span>
                                    <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                                </span></div>
                            <input type="hidden" name="totalMoney" value="<?php echo $total ?>">

                            <button type="submit" class="site-btn" name="btnDathang">Đặt
                                hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script>
function validateForm() {
    var firstname = document.forms["checkoutForm"]["firstname"].value;
    var lastname = document.forms["checkoutForm"]["lastname"].value;
    var address = document.forms["checkoutForm"]["address"].value;
    var sdt = document.forms["checkoutForm"]["sdt"].value;
    var email = document.forms["checkoutForm"]["email"].value;

    if (firstname == "") {
        alert("Vui lòng nhập Họ & tên");
        return false;
    }


    if (address == "") {
        alert("Vui lòng nhập Địa chỉ nhận hàng");
        return false;
    }

    if (sdt == "") {
        alert("Vui lòng nhập số điện thoại");
        return false;
    }

    if (email == "") {
        alert("Vui lòng nhập email");
        return false;
    }

    return true;
}
</script>

<!-- Checkout Section End -->

<!-- Footer Section Begin -->
<?php

require_once('components/footer.php');
?>