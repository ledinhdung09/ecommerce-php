<?php 
require('includes/header.php');
?>



<div>




    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center">
            <a href="trang-chu-admin" class="m-0 font-weight-bold text-primary" style="cursor: pointer;">Dashboard</a>
            <span class="mr-2 ml-2">/</span>
            <h6 class="m-0 font-weight-bold text-primary">Danh mục sản phẩm</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Từ khoá</th>

                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>STT</th>
                            <th>Tên danh mục</th>
                            <th>Từ khoá</th>

                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php 
    require('../db/conn.php');
    $sql_str = "select * from categories order by created_at desc";
    $result = mysqli_query($conn, $sql_str);
    $stt = 0;
    while ($row = mysqli_fetch_assoc($result)){
        $stt++;
        ?>


                        <tr>
                            <td width="50" style="align-content:center;"><?=$stt?></td>
                            <td style="align-content:center;"><?=$row['name']?></td>
                            <td style="align-content:center;"><?=$row['slug']?></td>
                            <td style="align-content:center;"><?=$row['status']?></td>
                            <td style="align-content:center;">
                                <a class="btn btn-warning"
                                    href="<?php echo 'danh-muc-san-pham/chi-tiet-' . $row['id']?>">Edit</a>
                                <a class="btn btn-danger" href="deletecategory.php?id=<?=$row['id']?>"
                                    onclick="return confirm('Bạn chắc chắn xóa mục này?');">Delete</a>
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