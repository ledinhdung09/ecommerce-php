<?php 
require('includes/header.php');
require('../db/conn.php');

// Khởi tạo biến $res và $status
$res = null; 
$status = '*';

if (isset($_POST['btnLocOrder'])) {
    $status = $_POST['selectStatus'];

    if ($status == '*') {
        $sql = "SELECT * FROM orders";
        $res = $conn->query($sql);
    } else {
        // Chuẩn bị câu lệnh SQL
        $stmt = $conn->prepare("SELECT * FROM orders WHERE status = ?");
        
        // Gắn tham số đầu vào của người dùng vào câu lệnh
        $stmt->bind_param("s", $status); // "s" đại diện cho kiểu dữ liệu của tham số. Dùng "i" nếu status là số nguyên.
        
        // Thực thi câu lệnh
        $stmt->execute();
        
        // Lấy kết quả
        $res = $stmt->get_result();
        
        // Đóng câu lệnh
        $stmt->close();
    }
}
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

            <form method="post" action="" class="d-none d-sm-inline-block form-inline mw-100 navbar-search"
                style="margin-right:14rem;">
                <div class="input-group">
                    <select name="selectStatus" id="" class="pl-4 pr-4"
                        style="border-top-left-radius: .35rem;border-bottom-left-radius: .35rem;">
                        <option value="*">Tất cả trạng thái</option>
                        <option value="Processing" <?= $status == 'Processing' ? 'selected' : '' ?>>Xử lý</option>
                        <option value="Confirmed" <?= $status == 'Confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                        <option value="Shipping" <?= $status == 'Shipping' ? 'selected' : '' ?>>Đang chuyển hàng
                        </option>
                        <option value="Delivered" <?= $status == 'Delivered' ? 'selected' : '' ?>>Đã giao hàng</option>
                        <option value="Cancelled" <?= $status == 'Cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" name="btnLocOrder">
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
                        $stt = 0;
                        if ($res) { // Kiểm tra nếu $res có giá trị
                            while ($row = $res->fetch_assoc()) {
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
                                <a class="btn btn-warning" href="vieworders.php?id=<?=$row['id']?>">Xem</a>
                            </td>
                        </tr>
                        <?php
                            }
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