<?php
session_start();
$is_homepage = false;
require_once('components/header.php');
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi Shop</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <div class="sidebar__item">
                        <h4>Danh mục sản phẩm</h4>
                        <ul>
                            <form action="timkiem.php">
                                <li><button name="danhmuc" value="*"
                                        style="border: 0; width: 100%;text-align:left;background: transparent;"
                                        type="submit">Tất cả danh mục</button></li>
                                <?php
                                
                                $sql_str = "select * from categories order by name";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)){
                            ?>
                                <li><button value="<?=$row['id']?>"
                                        style="border: 0; width: 100%;text-align:left;background: transparent;"
                                        name="danhmuc" type="submit"><?=$row['name']?></button></li>

                                <?php } ?>
                            </form>

                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Giá</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                data-min="10000" data-max="10000000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <input type="text" id="minamount">
                                    <input type="text" id="maxamount">
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Sản phẩm mới nhất</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    <?php
$sql_str = "SELECT * FROM `products` order by created_at desc limit 0, 3";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                                    <a href="<?php echo 'san_pham/chi-tiet-' . $row['id'].'/'.$row['slug']?> "
                                        class="latest-product__item" data-aos="fade-up">
                                        <div class="latest-product__item__pic">
                                            <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?=$row['name']?></h6>
                                            <!-- <span><?=$row['price']?></span> -->
                                            <div class="prices">
                                                <span
                                                    class="old"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                                <span
                                                    class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                            </div>
                                        </div>
                                    </a>
                                    <?php
}
?>

                                </div>
                                <div class="latest-prdouct__slider__item">
                                    <?php
$sql_str = "SELECT * FROM `products` order by created_at desc limit 3, 3";
$result = mysqli_query($conn, $sql_str);
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                                    <a href="<?php echo 'san_pham/chi-tiet-' . $row['id'].'/'.$row['slug']?>"
                                        class="latest-product__item" data-aos="fade-up">
                                        <div class="latest-product__item__pic">
                                            <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?=$row['name']?></h6>
                                            <div class="prices">
                                                <span
                                                    class="old"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                                <span
                                                    class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                            </div>
                                        </div>
                                    </a>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-7">
                <div class="product__discount">
                    <div class="section-title product__discount__title">
                        <h2>Giảm giá</h2>
                    </div>
                    <div class="row ">
                        <div class="product__discount__slider owl-carousel  ">
                            <?php
                                $sql_str = "SELECT products.slug as pslug, products.id as pid, products.name as pname, categories.name as cname, round((price - disscounted_price)/price*100) as discount, images, price, disscounted_price  FROM `products`, `categories` where products.category_id=categories.id order by discount desc limit 0, 6 ";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)){
                                    $anh_arr = explode(';', $row['images']);
                                ?>
                            <div class="col-lg-12 " data-aos="fade-up">
                                <div class="product__discount__item d-flex">
                                    <div class="product__discount__item__pic set-bg">
                                        <div class="product__discount__percent">-<?=$row['discount']?>%</div>
                                        <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                    </div>
                                    <div class="product__discount__item__text">
                                        <span><?=$row['cname']?></span>
                                        <h5><a
                                                href="<?php echo 'san_pham/chi-tiet-' . $row['pid'].'/'.$row['pslug']?>"><?=$row['pname']?></a>
                                        </h5>
                                        <!-- <div class="product__item__price"><?=$row['disscounted_price']?> <span><?=$row['price']?></span></div> -->
                                        <div class="prices">
                                            <span
                                                class="old"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                            <span
                                                class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>
                <div class="filter__item">
                    <div class="row">

                        <?php
                        if(isset($_GET['trang'])){
                            $page = $_GET['trang'];
                        }
                        else{
                         $page = "1";
                        }
                        if($page==""|| $page== "1"){
                        $begin = 0;
                        }
                        else{
                            $begin = ($page*6)-6;
                        }
                            $sql_str = "select * from products order by name DESC LIMIT $begin,6 ";
                            $sql_str1 = "select * from products";
                            $result = mysqli_query($conn, $sql_str);
                            $result1 = mysqli_query($conn, $sql_str1);
                            
                        ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6>Có <span><?=mysqli_num_rows($result1)?></span> sản phẩm</h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php
                        while ($row = mysqli_fetch_assoc($result)){
                            $anh_arr = explode(';', $row['images']);
                        ?>

                    <div class="col-lg-6 col-md-4 col-sm-6 mix" data-aos="fade-up">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg">
                                <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                            </div>
                            <div class="featured__item__text">
                                <h5>
                                    <a href="<?php echo 'san_pham/chi-tiet-' . $row['id'].'/'.$row['slug']?>">
                                        <?=$row['name']?>
                                    </a>
                                </h5>
                                <div class="prices">
                                    <span
                                        class="old d-block"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                    <span
                                        class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
                <?php 
                        $sql_trang = mysqli_query($conn,'SELECT * FROM products');
                        $sql_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($sql_count / 6);
                    ?>
                <div class="product__pagination">
                    <?php
                                for ($i=1; $i <= $trang; $i++) { 
                                    ?>
                    <a class="<?php if ($page == $i) {
                                echo 'active';
                            } else {
                                echo '';} ?>" href="<?php echo 'san_pham/trang-' . $i ?>"><?php echo $i ?></a>
                    <?php
                                } 
                            ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require_once('components/footer.php');
?>