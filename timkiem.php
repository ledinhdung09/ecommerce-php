<?php
session_start();
$is_homepage = false;
require_once('components/header.php');

//lay từ khóa tìm kiếm
$danhmuc = isset($_GET['danhmuc']) ? $_GET['danhmuc'] : '*';
$tukhoa = isset($_GET['tukhoa']) ? urldecode($_GET['tukhoa']) : '';

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
                        <span>Shop</a></span>
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
                        <h4>Price</h4>
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
                                    <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item"
                                        data-aos="fade-up">
                                        <div class="latest-product__item__pic">
                                            <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?=$row['name']?></h6>
                                            <!-- <span><?=$row['price']?></span> -->
                                            <div class="prices">
                                                <span class="old"><?=$row['price']?></span>
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
                                    <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item"
                                        data-aos="fade-up">
                                        <div class="latest-product__item__pic">
                                            <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6><?=$row['name']?></h6>
                                            <div class="prices">
                                                <span class="old"><?=$row['price']?></span>
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
                <h3>Kết quả tìm kiếm</h3>
                <div class="filter__item">
                    <div class="row">

                        <?php
                        
 if ($danhmuc == '*'){ ///* la tat ca danh muc nen bo qua dieu kien category_id = $danhmuc
    $sql_str = "select * from products where
        
        name like '%$tukhoa%' 
        
    order by name";
 } else {
    $sql_str = "select * from products where
        (category_id = $danhmuc)
        and 
        (name like '%$tukhoa%' )
    order by name";
 }
    
    // echo $sql_str; exit;
    $result = mysqli_query($conn, $sql_str);
    
?>
                        <div class="col-lg-4 col-md-4">
                            <div class="filter__found">
                                <h6>Có <span><?=mysqli_num_rows($result)?></span> sản phẩm</h6>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <?php
while ($row = mysqli_fetch_assoc($result)){
    $anh_arr = explode(';', $row['images']);
?>
                    <div class="col-lg-4 col-md-6 col-sm-6" data-aos="fade-up">
                        <div class="product__item">
                            <div class="product__item__pic set-bg">
                                <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                            </div>
                            <div class="product__item__text">
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

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php

require_once('components/footer.php');
?>