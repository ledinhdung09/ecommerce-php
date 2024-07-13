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
                    <h2>Lịch sử mua hàng</h2>
                    <div class="breadcrumb__option">
                        <a href="./trang-chu">Trang chủ</a>
                        <span>Lịch sử mua hàng</span>
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
            <div class="product__details__tab mt-4 pt-0">
                <ul class="nav nav-tabs " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">
                            Tất cả</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">
                            Đang xử lý</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">
                            Đã huỷ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tabs-4" role="tab" aria-selected="false">
                            Đã giao</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tabs-1" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <h6>Tất cả các đơn hàng</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                $user = $_SESSION['user'];
                                $us_ID = $user['id'];
                                $sql_str = "SELECT * FROM `orders` WHERE us_ID = $us_ID order by created_at desc";
                                $result = mysqli_query($conn, $sql_str);
                                $stt = 1;
                                 
                                while($row = mysqli_fetch_assoc($result)) {
                                        $order_id = $row['id'];
                                        $sql_str1 = "SELECT * FROM `order_details` WHERE order_id = $order_id";
                                        $result1 = mysqli_query($conn, $sql_str1);
                                        
                                        $total_price = 0; // Khởi tạo biến để tính tổng giá tiền
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $total_price += $row1['price'] * $row1['qty']; // Tính tổng giá tiền
                                        }
                                ?>
                                    <tr>
                                        <th style="align-content: center;" scope="row"><?= $stt ?></th>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['id']) ?></td>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['created_at']) ?>
                                        </td>
                                        <td style="align-content: center;">
                                            <?= number_format($total_price, 0, '', '.') . " VNĐ" ?></td>
                                        <td style="align-content: center;"><?php switch($row['status']){
                    case 'Processing':
                        echo 'Xử lý';
                        break;
                    case 'Confirmed':
                        echo 'Đã xác nhận';
                        break;
                    case 'Shipping':
                        echo 'Đang chuyển hàng';
                        break;
                    case 'Delivered':
                        echo 'Đã giao hàng';
                        break;
                    case 'Cancelled':
                        echo 'Đã huỷ';
                        break;
                } ?></td>
                                        <td style="align-content: center;"><a class="btn btn-warning"
                                                href="<?php echo 'lich-su-mua_hang/chi-tiet-don-hang-' . $row['id']?>">Xem</a>
                                        </td>
                                    </tr>

                                    <?php
                                    $stt++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <div class="tab-pane" id="tabs-2" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <h6>Tất cả các đơn hàng đang xử lý</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                $user = $_SESSION['user'];
                                $us_ID = $user['id'];
                                $sql_str = "SELECT * FROM `orders` WHERE us_ID = $us_ID and status = 'Processing' order by created_at desc";
                                $result = mysqli_query($conn, $sql_str);
                                $stt = 1;
                                 
                                while($row = mysqli_fetch_assoc($result)) {
                                        $order_id = $row['id'];
                                        $sql_str1 = "SELECT * FROM `order_details` WHERE order_id = $order_id";
                                        $result1 = mysqli_query($conn, $sql_str1);
                                        
                                        $total_price = 0; // Khởi tạo biến để tính tổng giá tiền
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $total_price += $row1['price'] * $row1['qty']; // Tính tổng giá tiền
                                        }
                                ?>
                                    <tr>
                                        <th style="align-content: center;" scope="row"><?= $stt ?></th>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['id']) ?></td>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['created_at']) ?>
                                        </td>
                                        <td style="align-content: center;">
                                            <?= number_format($total_price, 0, '', '.') . " VNĐ" ?></td>
                                        <td style="align-content: center;"><?php switch($row['status']){
                    case 'Processing':
                        echo 'Xử lý';
                        break;
                    case 'Confirmed':
                        echo 'Đã xác nhận';
                        break;
                    case 'Shipping':
                        echo 'Đang chuyển hàng';
                        break;
                    case 'Delivered':
                        echo 'Đã giao hàng';
                        break;
                    case 'Cancelled':
                        echo 'Đã huỷ';
                        break;
                } ?></td>
                                        <td style="align-content: center;">
                                            <a class="btn btn-warning"
                                                href="<?php echo 'lich-su-mua_hang/chi-tiet-don-hang-' . $row['id']?>">
                                                Xem
                                            </a>

                                            <a class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?= htmlspecialchars($row['id']) ?>">
                                                Huỷ đơn
                                            </a>
                                            <div class="modal fade" id="exampleModal<?= htmlspecialchars($row['id']) ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Huỷ đơn hàng
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn muốn huỷ đơn hàng có mã
                                                            <?= htmlspecialchars($row['id']) ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Huỷ</button>
                                                            <form action="xulyhuydon.php" method="post">
                                                                <button type="submit" name="btnCancel"
                                                                    value="<?= htmlspecialchars($row['id']) ?>"
                                                                    class="text-white success btn btn-primary">
                                                                    Đồng ý
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $stt++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-3" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <h6>Tất cả các đơn hàng đã huỷ</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                $user = $_SESSION['user'];
                                $us_ID = $user['id'];
                                $sql_str = "SELECT * FROM `orders` WHERE us_ID = $us_ID and status = 'Cancelled' order by created_at desc";
                                $result = mysqli_query($conn, $sql_str);
                                $stt = 1;
                                 
                                while($row = mysqli_fetch_assoc($result)) {
                                        $order_id = $row['id'];
                                        $sql_str1 = "SELECT * FROM `order_details` WHERE order_id = $order_id";
                                        $result1 = mysqli_query($conn, $sql_str1);
                                        
                                        $total_price = 0; // Khởi tạo biến để tính tổng giá tiền
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $total_price += $row1['price'] * $row1['qty']; // Tính tổng giá tiền
                                        }
                                ?>
                                    <tr>
                                        <th style="align-content: center;" scope="row"><?= $stt ?></th>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['id']) ?></td>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['created_at']) ?>
                                        </td>
                                        <td style="align-content: center;">
                                            <?= number_format($total_price, 0, '', '.') . " VNĐ" ?></td>
                                        <td style="align-content: center;"><?php switch($row['status']){
                    case 'Processing':
                        echo 'Xử lý';
                        break;
                    case 'Confirmed':
                        echo 'Đã xác nhận';
                        break;
                    case 'Shipping':
                        echo 'Đang chuyển hàng';
                        break;
                    case 'Delivered':
                        echo 'Đã giao hàng';
                        break;
                    case 'Cancelled':
                        echo 'Đã huỷ';
                        break;
                } ?></td>
                                        <td style="align-content: center;">
                                            <a class="btn btn-warning"
                                                href="<?php echo 'lich-su-mua_hang/chi-tiet-don-hang-' . $row['id']?>">
                                                Xem
                                            </a>
                                            <a class="btn btn-success" data-bs-toggle="modal"
                                                data-bs-target="#exampleModal<?= htmlspecialchars($row['id']) ?>">
                                                Mua lại
                                            </a>
                                            <div class="modal fade" id="exampleModal<?= htmlspecialchars($row['id']) ?>"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                Mua lại đơn
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn muốn mua lại đơn hàng có mã
                                                            <?= htmlspecialchars($row['id']) ?>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Huỷ</button>
                                                            <form action="xulymualaidon.php" method="post">
                                                                <button type="submit" name="btnMuaLai"
                                                                    value="<?= htmlspecialchars($row['id']) ?>"
                                                                    class="text-white success btn btn-primary">
                                                                    Đồng ý
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <?php
                                    $stt++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane" id="tabs-4" role="tabpanel">
                        <div class="product__details__tab__desc">
                            <h6>Tất cả các đơn hàng đã giao hàng thành công</h6>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Thời gian</th>
                                        <th scope="col">Tổng tiền</th>
                                        <th scope="col">Trạng thái</th>
                                        <th scope="col">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php
                                $user = $_SESSION['user'];
                                $us_ID = $user['id'];
                                $sql_str = "SELECT * FROM `orders` WHERE us_ID = $us_ID and status = 'Delivered' order by created_at desc";
                                $result = mysqli_query($conn, $sql_str);
                                $stt = 1;
                                 
                                while($row = mysqli_fetch_assoc($result)) {
                                        $order_id = $row['id'];
                                        $sql_str1 = "SELECT * FROM `order_details` WHERE order_id = $order_id";
                                        $result1 = mysqli_query($conn, $sql_str1);
                                        
                                        $total_price = 0; // Khởi tạo biến để tính tổng giá tiền
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $total_price += $row1['price'] * $row1['qty']; // Tính tổng giá tiền
                                        }
                                ?>
                                    <tr>
                                        <th style="align-content: center;" scope="row"><?= $stt ?></th>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['id']) ?></td>
                                        <td style="align-content: center;"><?= htmlspecialchars($row['created_at']) ?>
                                        </td>
                                        <td style="align-content: center;">
                                            <?= number_format($total_price, 0, '', '.') . " VNĐ" ?></td>
                                        <td style="align-content: center;"><?php switch($row['status']){
                    case 'Processing':
                        echo 'Xử lý';
                        break;
                    case 'Confirmed':
                        echo 'Đã xác nhận';
                        break;
                    case 'Shipping':
                        echo 'Đang chuyển hàng';
                        break;
                    case 'Delivered':
                        echo 'Đã giao hàng';
                        break;
                    case 'Cancelled':
                        echo 'Đã huỷ';
                        break;
                } ?></td>
                                        <td style="align-content: center;"><a class="btn btn-warning"
                                                href="<?php echo 'lich-su-mua_hang/chi-tiet-don-hang-' . $row['id']?>">Xem</a>
                                        </td>
                                    </tr>

                                    <?php
                                    $stt++;
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script>
document.querySelectorAll('.success').forEach(function(button) {
    button.addEventListener('click', function() {
        // Ẩn tất cả các modal
        document.querySelectorAll('.modal.show').forEach(function(modal) {
            let modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();
        });
    });
});;
</script>

<?php

require_once('components/footer.php');
?>