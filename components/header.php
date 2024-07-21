<?php //session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <link rel="shortcut icon" href="./images/logo_icon.png" type="image/x-icon" />
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cửa hàng rau củ quả</title>

    <!-- Css Styles -->
    <base href="http://localhost/webbanhang/" />
    <link rel="stylesheet" href="../webbanhang/css/bootstrap.css">
    <link rel="stylesheet" href="../webbanhang/css/bootstrap.min.css">
    <link rel="stylesheet" href="../webbanhang/css/elegant-icons.css">
    <link rel="stylesheet" href="../webbanhang/css/nice-select.css">
    <link rel="stylesheet" href="../webbanhang/css/jquery-ui.min.css">
    <link rel="stylesheet" href="../webbanhang/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../webbanhang/css/slicknav.min.css">
    <link rel="stylesheet" href="../webbanhang/css/fontawesome.pro.6.0.0.css">
    <link rel="stylesheet" href="../webbanhang/css/font-awesome.min.css">
    <link rel="stylesheet" href="../webbanhang/css/style.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>

<body id="pagetop">
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.png" alt=""></a>
        </div>

        <div class="humberger__menu__widget">
            <!-- <div class="header__top__right__language">
                <img src="../img/language.png" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div> -->
            <?php

                                    if (isset($_SESSION['user'])) {
                                        $user = $_SESSION['user'];
                                        // User is logged in
                                        echo '<span class="logged-in-user mr-2">Hello, ' . $user['name'] . '</span>';
                                       echo ' <div class="dropdown">
                                                <button class="bg-transparent border-0 rounded-circle dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded-circle" style="width:40px;" src="./img/avatar.png" alt="">
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="dang-xuat">Đăng xuất</a></li>
                                                    <li><a class="dropdown-item" href="lich-su-mua-hang">Lịch sử mua hàng</a></li>
                                                </ul>
                                                </div>';
                                    } else {
                                        // User is not logged in
                                        echo '<a href="dang-nhap">Đăng nhập</a>';
                                    }
                                    ?>
        </div>
        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href=".trang-chu/">Trang chủ</a></li>
                <li><a href="/san-pham">Cửa hàng</a></li>
                <li><a href="./tin-tuc">Tin tức</a></li>
                <li><a href="./lien-he">Liên hệ</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> ledinhdung@gmail.com</li>
                <li>Shop Rau Củ Quả Sạch</li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> ledinhdung@gmail.com</li>
                                <li>Shop Rau Củ Quả Sạch</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right d-flex align-items-center">
                            <div class="header__top__right__social">
                                <i class="fa fa-phone"></i> 0828.212.825
                                <a href="#/"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>

                            <div class="header__top__right__auth d-flex align-items-center">

                                <?php

                                    if (isset($_SESSION['user'])) {
                                        $user = $_SESSION['user'];
                                        // User is logged in
                                        echo '<span class="logged-in-user mr-2">Hello, ' . $user['name'] . '</span>';
                                       echo ' <div class="dropdown">
                                                <button class="bg-transparent border-0 rounded-circle dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <img class="rounded-circle" style="width:40px;" src="./img/avatar.png" alt="">
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a class="dropdown-item" href="dang-xuat">Đăng xuất</a></li>
                                                    <li><a class="dropdown-item" href="lich-su-mua-hang">Lịch sử mua hàng</a></li>
                                                </ul>
                                                </div>';
                                    } else {
                                        // User is not logged in
                                        echo '<a href="dang-nhap">Đăng nhập</a>';
                                    }
                                    ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./trang-chu"><img style="width:80%;" src="images/logo-removebg-preview.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div class="hero__search"> -->
                    <div class="hero__search__form">
                        <form action="timkiem.php" method="get" style="display:flex;align-items:center;">
                            <!-- <div class="hero__search__categories"> -->
                            <!-- Tất cả danh mục
                                    <span class="arrow_carrot-down"></span> -->
                            <select name="danhmuc">
                                <option value='*'>Tất cả danh mục</option>
                                <?php
                                    require('./db/conn.php');
                                    $sql_str = "select * from categories order by name";
                                    $result = mysqli_query($conn, $sql_str);
                                    $danhmuc = isset($_GET['danhmuc']) ? $_GET['danhmuc'] : '*';
                                    $tukhoa = isset($_GET['tukhoa']) ? urldecode($_GET['tukhoa']) : '';

                                    while ($row = mysqli_fetch_assoc($result)){
                                        $selected = ($danhmuc == $row['id']) ? 'selected' : '';
                                ?>
                                <option value="<?=$row['id']?>" <?=$selected?>><?=$row['name']?></option>
                                <?php } ?>
                            </select>

                            <!-- </div> -->
                            <input type="text" name="tukhoa" value="<?=$tukhoa?>" placeholder="Bạn cần tìm gì?">
                            <button type="submit" class="site-btn">Tìm</button>
                        </form>
                    </div>

                    <!-- </div> -->
                </div>

                <!-- <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="/">Home</a></li>
                            <li><a href="/shop.php">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div> -->
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>

                            <li><a href="./gio-hang"><i class="fa fa-shopping-bag"></i> <span>
                                        <?php
                                    $cart = [];
                                    if (isset($_SESSION['cart'])) {
                                        $cart = $_SESSION['cart'];
                                    }
                                    $count = 0;  //hien thi so luong san pham trong gio hang
                                    $tongtien = 0;
                                    foreach ($cart as $item) {
                                        $count += $item['qty'];
                                        $tongtien += $item['qty'] * $item['disscounted_price'];
                                    }   
                                    //hien thi so luong
                                    echo $count;
                                ?>
                                    </span></a></li>
                        </ul>
                        <div class="header__cart__price">Tổng tiền:
                            <span><?=number_format($tongtien, 0, '', '.'). " VNĐ" ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
    <?php   
    if ($is_homepage){
        echo '<section class="hero">';
    } else {
        echo '<section class="hero hero-normal">';
    }
    ?>
    <!-- <section class="hero"> -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Danh mục sản phẩm</span>
                    </div>
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
            </div>
            <div class="col-lg-9">
                <!-- <div class="col-lg-6"> -->
                <?php
                    $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
                    $query_string = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);

                    // Lấy phần đường dẫn sau thư mục gốc 'webbanhang'
                    $path_parts = explode('/', trim($current_path, '/'));
                    $main_page = isset($path_parts[1]) ? $path_parts[1] : '';
                     parse_str($query_string, $query_params);
                    $is_search_for_shop = isset($query_params['danhmuc']) && $query_params['danhmuc'] != '';

                    // Đặt class active dựa trên phần chính của đường dẫn
                    $is_home_active = $main_page == '' || $main_page == 'trang-chu';
                    $is_shop_active = $main_page == 'san-pham'||$main_page == 'san_pham'||$is_search_for_shop;
                    $is_news_active = $main_page == 'tin-tuc'||$main_page == 'tin_tuc';
                    $is_contact_active = $main_page == 'lien-he';
                ?>

                <nav class="header__menu">
                    <ul>
                        <li class="<?= $is_home_active ? 'active' : '' ?>"><a href="./trang-chu">Trang chủ</a></li>
                        <li class="<?= $is_shop_active ? 'active' : '' ?>"><a href="./san-pham">Cửa hàng</a></li>
                        <li class="<?= $is_news_active ? 'active' : '' ?>"><a href="./tin-tuc">Tin tức</a></li>
                        <li class="<?= $is_contact_active ? 'active' : '' ?>"><a href="./lien-he">Liên hệ</a></li>
                    </ul>
                </nav>


                <!-- </div> -->

                <?php   
    if ($is_homepage){
       ?>
                <div class="hero__item set-bg" data-setbg="img/hero/banner.jpg">
                    <div class="hero__text">
                        <span>FRUIT FRESH</span>
                        <h2>Vegetable <br />100% Organic</h2>
                        <p>Free Pickup and Delivery Available</p>
                        <a href="./san-pham" class="primary-btn">SHOP NOW</a>
                    </div>
                </div>
                <?php
    }
    ?>

            </div>
        </div>
    </div>
    </section>
    <!-- Hero Section End -->