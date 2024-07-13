<?php 
require('includes/header.php');
require('../db/conn.php');

$sql_str = "select 
* from orders";
// echo $sql_str; exit;   //debug cau lenh

$res = mysqli_query($conn, $sql_str);

$row = mysqli_fetch_assoc($res);
?>
<style>
.Processing,
.Confirmed,
.Shipping,
.Delivered,
.Cancelled {
    display: block;

}

.Processing {
    background-color: orange;
}

.Confirmed {
    background-color: yellowgreen;
}

.Shipping {
    background-color: lightblue;
}

.Delivered {
    background-color: green;
}

.Cancelled {
    background-color: red;
}
</style>
<div>




    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <a href="trang-chu-admin" class="m-0 font-weight-bold text-primary "
                    style="cursor: pointer;">Dashboard</a>
                <span class="mr-2 ml-2">/</span>
                <h6 class="m-0 font-weight-bold text-primary">Đơn hàng</h6>
            </div>

            <form method="post" action="loc-don-hang" class="d-none d-sm-inline-block form-inline mw-100 navbar-search"
                style="margin-right:14rem;">
                <div class="input-group">
                    <select name="selectStatus" id="" class="pl-4 pr-4"
                        style="border-top-left-radius: .35rem;border-bottom-left-radius: .35rem;">
                        <option value="*">Tất cả trạng thái</option>
                        <option value="Processing">Xử lý </option>
                        <option value="Confirmed">Đã xác nhận </option>
                        <option value="Shipping">Đang chuyển hàng </option>
                        <option value="Delivered">Đã giao hàng </option>
                        <option value="Cancelled">Đã hủy </option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" name="btnLocOrder" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>Xem</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
    require('../db/conn.php');
    $sql_str = "select 
    * from orders
    order by created_at desc";
    $result = mysqli_query($conn, $sql_str);
    $stt = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $stt++;
        ?>
                        <tr>
                            <td width="50" style="align-content:center;"><?=$stt?></td>
                            <td style="align-content:center;"><?=$row['id']?></td>
                            <td style="align-content:center;"><?=$row['created_at']?></td>
                            <td style="align-content:center;"><span class='p-1 pl-3 <?=$row['status']?>'><?php switch($row['status']){
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
                } ?></span></td>

                            <td>
                                <a class="btn btn-warning" href="<?php echo 'don-hang/chi-tiet-' . $row['id']?>">Xem</a>

                            </td>

                        </tr>
                        <?php
    }
    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<?php
require('includes/footer.php');
?>