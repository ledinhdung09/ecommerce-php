<?php
session_start();
$is_homepage = true;
require_once("./config/Exception.php");
require_once("./config/PHPMailer.php");
require_once("./config/SMTP.php");
require_once("./config/function.php");
include('components/header.php');
 
?>

<?php 
    if (isset($_SESSION['user'])) {
        include('guide_products.php');
    }

?>
<!-- Featured Section Begin -->

<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Sản phẩm đặc trưng</h2>
                </div>
                <div class="featured__controls">
                    <ul>
                        <li class="active" data-filter="*">All</li>
                        <?php
                 $sql_str = "select * from categories order by name";
                 $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)){
                ?>
                        <li data-filter=".<?=$row['slug']?>"><?=$row['name']?></li>
                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>
        <div class="row featured__filter">
            <?php
                 $sql_str = "SELECT products.id as pid, products.slug as pslug, products.name as pname, images, price,disscounted_price, categories.slug as cslug from products, categories where products.category_id=categories.id; ";
                 $result = mysqli_query($conn, $sql_str);
                    while ($row = mysqli_fetch_assoc($result)){
                        $anh_arr = explode(';', $row['images']);
                ?>
            <div data-aos="fade-up" class="col-lg-4 col-md-4 col-sm-6 mix <?=$row['cslug']?>">
                <div class="featured__item">
                    <div class="featured__item__pic set-bg">
                        <img src="<?="quantri/".$anh_arr[0]?>" alt="">
                    </div>
                    <div class="featured__item__text">
                        <h5><a
                                href="<?php echo 'san_pham/chi-tiet-' . $row['pid'].'/'. $row['pslug']?>"><?=$row['pname']?></a>
                        </h5>
                        <div class="prices">
                            <span class="old"><?=$row['price']?></span>
                            <span
                                class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>


        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div data-aos="fade-up" class="banner__pic">
                    <img src="img/banner/banner-1.jpg" alt="">
                </div>
            </div>
            <div data-aos="fade-up" class="col-lg-6 col-md-6 col-sm-6">
                <div class="banner__pic">
                    <img src="img/banner/banner-2.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Banner End -->


<!-- Latest Product Section End -->

<!-- Blog Section Begin -->
<section class="from-blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title from-blog__title">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <?php 

                $sql_str="select * from news order by created_at desc limit 0, 3";
            $result = mysqli_query($conn, $sql_str);
            while ($row = mysqli_fetch_assoc($result)){

                ?>
            <div class="col-lg-4 col-md-4 col-sm-6" data-aos="fade-up">
                <div class="blog__item">
                    <div class="blog__item__pic">
                        <img src="<?='quantri/'.$row['avatar']?>" alt="">
                    </div>
                    <div class="blog__item__text">
                        <ul>
                            <li><i class="fa fa-calendar-o"></i> <?=$row['created_at']?></li>
                            <li><i class="fa fa-comment-o"></i> 5</li>
                        </ul>

                        <h5><a
                                href="<?php echo 'tin_tuc/chi-tiet-' . $row['id'].'/'.$row['slug']?>"><?=$row['title']?></a>
                        </h5>
                        <p><?=$row['sumary']?></p>
                    </div>
                </div>
            </div>
            <?php } ?>

        </div>
    </div>
</section>
<!-- Blog Section End -->
<?php

require_once('components/footer.php');
?>