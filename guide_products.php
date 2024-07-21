<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <h2>Gợi ý sản phẩm</h2>
                </div>
                <div class="row featured__filter">
                    <?php
                        $user = $_SESSION['user'];
                        $us_ID = $user['id'];
                        $sql_str = "SELECT products.id AS pid, products.slug AS pslug, products.name AS pname, products.images, products.price, products.disscounted_price 
                                    FROM products
                                    JOIN guide_products ON products.id = guide_products.product_id
                                    WHERE guide_products.us_id = ? order by guide_products.created_at desc , guide_products.click desc";
                        $stmt = $conn->prepare($sql_str);
                        $stmt->bind_param("i", $us_ID);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($row = $result->fetch_assoc()) {
                            $anh_arr = explode(';', $row['images']);
                            ?>
                    <div class="col-lg-4 col-md-4 col-sm-6 mix">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg">
                                <img src="<?= "quantri/" . $anh_arr[0] ?>" alt="">
                            </div>
                            <div class="featured__item__text">
                                <h5>
                                    <a href="<?= 'san_pham/chi-tiet-' . $row['pid'] . '/' . $row['pslug'] ?>">
                                        <?= htmlspecialchars($row['pname'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </h5>
                                <div class="prices">
                                    <span class="old"><?= number_format($row['price'], 0, '', '.') . " VNĐ" ?></span>
                                    <span
                                        class="curr"><?= number_format($row['disscounted_price'], 0, '', '.') . " VNĐ" ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                        ?>



                </div>
            </div>
        </div>

    </div>
</section>