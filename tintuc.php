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
                    <h2>Tin tức</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Home</a>
                        <span>Tin tức</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="blog__sidebar">
                    <div class="blog__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Search...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Thể loại</h4>
                        <ul>
                            <?php
                                require('./db/conn.php');
                                $sql_str = "select * from newscategories order by name";
                                $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)){
                                ?>
                            <li><a href="#"><?=$row['name']?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="blog__sidebar__item">
                        <h4>Tin tức gần đây</h4>
                        <div class="blog__sidebar__recent">
                            <?php
                                require('./db/conn.php');
                                $sql_str = "SELECT news.id as nid,news.slug as nslug,news.title as ntitle,news.avatar as navatar,news.created_at as ncreated_at,newscategories.name as cname FROM news,newscategories where news.newscategory_id = newscategories.id ORDER BY news.created_at DESC  LIMIT 3";
                                $result = mysqli_query($conn, $sql_str);

                                while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                            <a href="<?php echo 'tin_tuc/chi-tiet-' . $row['nid'].'/'.$row['nslug']?>"
                                class="blog__sidebar__recent__item">
                                <div class="blog__sidebar__recent__item__pic">
                                    <img style="width: 100px;" src="quantri/<?php echo $row['navatar']; ?>" alt="">
                                </div>
                                <div class="blog__sidebar__recent__item__text">
                                    <h6><?php echo $row['ntitle']; ?><br /> <?php echo $row['cname']; ?>
                                    </h6>
                                    <span><?php echo $row['ncreated_at']; ?></span>
                                </div>
                            </a>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-8 col-md-7">
                <div class="row">
                    <?php
                        require('./db/conn.php');
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
                        $sql_str = "SELECT * FROM news ORDER BY created_at DESC LIMIT $begin,6 ";
                        $result = mysqli_query($conn, $sql_str);

                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="quantri/<?php echo $row['avatar']; ?>" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i><?php echo $row['created_at']; ?></li>

                                </ul>
                                <h5><a
                                        href="<?php echo 'tin_tuc/chi-tiet-' . $row['id'].'/'.$row['slug']?>"><?php echo $row['title']; ?></a>
                                </h5>
                                <p><?php echo $row['sumary']; ?></p>
                                <a href="<?php echo 'tin_tuc/chi-tiet-' . $row['id'].'/'.$row['slug']?>"
                                    class="blog__btn">
                                    Đọc thêm
                                    <span class="arrow_right"></span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <?php 
                    } 
                    ?>
                    <?php 
                        $sql_trang = mysqli_query($conn,'SELECT * FROM news');
                        $sql_count = mysqli_num_rows($sql_trang);
                        $trang = ceil($sql_count / 6);
                    ?>

                    <div class="col-lg-12">
                        <div class="product__pagination blog__pagination">
                            <?php
                                for ($i=1; $i <= $trang; $i++) { 
                                    ?>
                            <a class="<?php if ($page == $i) {
                                echo 'active';
                            } else {
                                echo '';} ?>" href="<?php echo 'tin_tuc/trang-' . $i ?>"><?php echo $i ?></a>
                            <?php
                                } 
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Blog Section End -->



<?php
require_once('components/footer.php');
?>