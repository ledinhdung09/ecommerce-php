<?php
session_start();
$is_homepage = false;

require_once('./db/conn.php');



require_once('components/header.php');
?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Giỏ hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Trang chủ</a>
                        <span>Giỏ hàng</span>
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
            <h4>Giỏ hàng</h4>
            <!-- <form action="#"> -->
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="checkout__order">
                        <h4>Đơn hàng của bạn</h4>
                        <div class="checkout__order__products">
                            Sản phẩm
                        </div>
                        <table class="table">
                            <tr>
                                <th>STT</th>
                                <th>Tên sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th colspan="2">Hành động</th>
                            </tr>
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
                            <form action="updatecart.php?id=<?= $item['id'] ?>" method="post">

                                <tr>
                                    <td style="align-content:center">
                                        <?= ++$count ?>
                                    </td>
                                    <td style="align-content:center">
                                        <?= $item['name'] ?>
                                    </td>
                                    <td style="align-content:center">
                                        <?= number_format($item['disscounted_price'], 0, '', '.') . " VNĐ" ?>
                                    </td>
                                    <td style="align-content:center"><input type="number" name="qty"
                                            value="<?= $item['qty'] ?>" min="1" /></td>
                                    <td style="align-content:center">
                                        <?= number_format($item['disscounted_price'] * $item['qty'], 0, '', '.') . " VNĐ" ?>
                                    </td>
                                    <td><button class="btn btn-warning">Cập nhật</button></td>
                                    <td><a href='./deletecart.php?id=<?= $item['id'] ?>' class="btn btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            </form>

                            <?php
                            }
                            ?>


                        </table>
                        <!-- <div class="checkout__order__subtotal">
                  Subtotal <span>$750.99</span>
                </div> -->
                        <div class="checkout__order__total">
                            Tổng tiền: <span>
                                <?= number_format($total, 0, '', '.') . " VNĐ" ?>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="san-pham" class="btn btn-primary">Tiếp tục mua sắm</a>

                            <a href="javascript:void(0);" onclick="redirectToCheckout();" class="btn btn-success">
                                Thanh toán
                            </a>


                        </div>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div>
</section>
<!-- Checkout Section End -->
<script>
function redirectToCheckout() {
    var cart = <?php echo json_encode($cart); ?>;
    if (cart.length === 0) {
        alert("Chưa có sản phẩm nào trong giỏ hàng!");
    } else {
        location.href = "thanh-toan";
    }
}
</script>
<?php

require_once('components/footer.php');
?>