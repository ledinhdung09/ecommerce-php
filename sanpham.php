<?php
    session_start();
    $is_homepage = false;

    require_once('./db/conn.php');

    //kiem tra nut them vao gio duoc nhan
    if (isset($_POST['atcbtn'])) {
        $id = $_POST['pid'];
        $qty = $_POST['qty'];
        // them san pham vao gio hang
        $cart = [];
        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }
        // print_r($cart);
        $isFound = false;
        for ($i = 0; $i < count($cart); $i++) {
            // print_r($cart[$i]);
            if ($cart[$i]['id'] == $id) {
                $cart[$i]['qty']+= $qty; 
                $isFound = true;
                break;
            }
        }
        if (!$isFound) {  //khong tim thay san pham trong gio
            $sql_str = "select * from products where id = $id";
            // echo $sql_str; exit;
            $result = mysqli_query($conn, $sql_str);
            $product = mysqli_fetch_assoc($result);//thuc thi cau lenh ('select * from products where id = '.$id, true);
            $product['qty'] = $qty;
            $cart[] = $product;
        }

        //update session
        $_SESSION['cart'] = $cart;
        // print_r($cart); exit;
    }



    require_once('components/header.php');

    //toi uu code sau
    $idsp = $_GET['id'];
    $sql_str = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql_str);
    $stmt->bind_param("i", $idsp);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $anh_arr = explode(';', $row['images']);


    if(isset($_SESSION['user'])){
        // Thêm sản phẩm vào gợi ý
        $user = $_SESSION['user'];
        $us_ID = $user['id'];

        $sql_str1 = "SELECT * FROM guide_products WHERE product_id=? AND us_id=?";
        $stmt1 = $conn->prepare($sql_str1);
        $stmt1->bind_param("ii", $idsp, $us_ID);
        $stmt1->execute();
        $result1 = $stmt1->get_result();

        if ($result1->num_rows > 0) {
            // Cộng click của hàng đó lên 1
            $sql_update = "UPDATE guide_products SET click = click + 1 WHERE product_id=? AND us_id=?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ii", $idsp, $us_ID);
            $stmt_update->execute();
        } else {
            // Thêm sản phẩm vào bảng guide_products
            $sql_insert = "INSERT INTO guide_products (us_id, product_id, click, created_at) VALUES (?, ?, ?, NOW())";
            $stmt_insert = $conn->prepare($sql_insert);
            if ($stmt_insert === false) {
                die('Prepare failed: ' . htmlspecialchars($conn->error));
            }
            $click = 1;
            $stmt_insert->bind_param("iii", $us_ID, $idsp, $click);
            $stmt_insert->execute();
        }
    }
    
  


    ?>
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>
                        <?= $row['name'] ?>
                    </h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Trang chủ</a>
                        <a href="./san-pham">Sản phẩm</a>
                        <span>
                            <?= $row['name'] ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="<?= "quantri/" . $anh_arr[0] ?>"
                            alt="<?= $row['name'] ?>">
                    </div>
                    <div class="product__details__pic__slider owl-carousel">
                        <?php
                            for ($i = 0; $i < count($anh_arr); $i++) {
                                ?>
                        <img data-imgbigurl="<?= "quantri/" . $anh_arr[$i] ?>" src="<?= "quantri/" . $anh_arr[$i] ?>">
                        <?php
                            }
                            ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3>
                        <?= $row['name'] ?>
                    </h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price price_old">
                        Giá gốc: <?= number_format($row['price'], 0, ',', '.') ?> ₫
                    </div>
                    <div class="product__details__price">
                        Giá khuyến mãi: <?= number_format($row['disscounted_price'], 0, ',', '.') ?> ₫
                    </div>

                    <p>
                        <?= $row['summary'] ?>
                    </p>
                    <form method="post">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                    <input type="hidden" value="1" name="qty">
                                </div>
                                <input type="hidden" name="pid" value="<?=$idsp?>">
                            </div>
                        </div>
                        <button class="primary-btn" name="atcbtn">Thêm vào giỏ hàng</button>
                    </form>

                    <ul>
                        <li><b>Trạng thái</b> <span>Còn hàng</span></li>
                        <li><b>Giao hàng</b> <span>Giao hàng trong 1 ngày. <samp>Nhận hàng miễn phí</samp></span></li>
                        <li><b>Khối lượng</b> <span>0.5 kg</span></li>
                        <li><b>Chia sẻ</b>
                            <div class="share">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                aria-selected="true">Mô tả</a>
                        </li>
                        <!-- <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                    aria-selected="false">Information</a>
                            </li> -->
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Đánh
                                giá <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Thông tin sản phẩm</h6>
                                <?= $row['description'] ?>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <?php
                                    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                                    
                                ?>

                                <div class="fb-comments" data-href="<?php echo $url ?>" data-width="100%"
                                    data-numposts="10">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Các sản phẩm liên quan</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
//tim cac san pham lien quan cung category_id voi san pham nay
$dmid = $row['category_id'];
$sql2 = "select * from products where category_id=$dmid  and id <> $idsp";
$result2 = mysqli_query($conn, $sql2);
while($row2 = mysqli_fetch_assoc($result2)) {
    $arrs = explode(";", $row2["images"]);
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up">

                <div class="product__item">
                    <div class="product__item__pic set-bg">
                        <img src="<?="quantri/".$arrs[0]?>" alt="">
                    </div>
                    <div class="product__item__text">
                        <h5>
                            <a href="<?php echo 'san_pham/chi-tiet-' . $row2['id'].'/'.$row2['slug']?>">
                                <?=$row2['name']?>
                            </a>
                        </h5>
                        <div class="prices">
                            <span
                                class="curr"><?= number_format($row2['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Related Product Section End -->
<?php require_once('components/footer.php'); ?>