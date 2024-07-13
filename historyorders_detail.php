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
                    <h2>Chi tiết đơn hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Trang chủ</a>
                        <a href="./lich-su-mua-hang">Đơn hàng</a>
                        <span>Chi tiết đơn hàng</span>
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
        <div class="col-lg-12">
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
                        </tr>
                        <?php
                                $id = $_GET['id'];
                                $sql_str = "SELECT * FROM `order_details` WHERE order_id = $id ";
                                $result = mysqli_query($conn, $sql_str);
                                $stt = 1;
                                $total_price = 0; 
                          
                            while($row = mysqli_fetch_assoc($result)) {
                                    $total_price += $row['price'] * $row['qty']; // Tính tổng giá tiền
                                ?>
                        <tr>
                            <td style="align-content:center">
                                <?= $stt ?>
                            </td>
                            <td style="align-content:center">
                                <?php
                                $id_product = $row['product_id'];
                                $sql_str1 = "SELECT name FROM `products` WHERE id = $id_product ";
                                $result1 = mysqli_query($conn, $sql_str1);
                                $product = mysqli_fetch_assoc($result1); // Lấy hàng từ kết quả truy vấn
                                echo htmlspecialchars($product['name']); // Hiển thị tên sản phẩm
                                ?>
                            </td>
                            <td style="align-content:center">
                                <?= number_format($row['price'], 0, '', '.') . " VNĐ" ?>
                            </td>
                            <td style="align-content:center"><?= $row['qty'] ?></td>
                            <td style="align-content:center">
                                <?= number_format($row['price'] * $row['qty'], 0, '', '.') . " VNĐ" ?>
                            </td>

                            </td>
                        </tr>


                        <?php
                            }
                            ?>


                    </table>
                    <!-- <div class="checkout__order__subtotal">
                  Subtotal <span>$750.99</span>
                </div> -->
                    <div class="checkout__order__total">
                        Tổng tiền: <span>
                            <?= number_format($total_price, 0, '', '.') . " VNĐ" ?>
                        </span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="lich-su-mua-hang" class="btn btn-primary">Quay lại</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<?php

require_once('components/footer.php');
?>