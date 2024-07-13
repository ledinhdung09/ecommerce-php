<?php 
require('includes/header.php');
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm mới sản phẩm</h1>
                        </div>
                        <form name="addAccountForm" class="user" method="post" action="addproduct.php"
                            enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Các hình ảnh cho sản phẩm</label>
                                <input type="file" class="form-control form-control-user" id="anhs" name="anhs[]"
                                    multiple>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt sản phẩm:</label>
                                <textarea name="sumary" class="form-control" placeholder="Nhập..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mô tả sản phẩm:</label>
                                <textarea name="description" class="form-control" placeholder="Nhập..."></textarea>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-sm-0">
                                    <label class="form-label">Số lượng:</label>
                                    <input type="number" class="form-control form-control-user" id="stock" name="stock"
                                        placeholder="Số lượng nhập:">
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <label class="form-label">Giá gốc:</label>
                                    <input type="number" class="form-control form-control-user" id="giagoc"
                                        name="giagoc" placeholder="Giá gốc">
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <label class="form-label">Giá bán:</label>
                                    <input type="number" class="form-control form-control-user" id="giaban"
                                        name="giaban" placeholder="Giá bán:">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục:</label>
                                <select class="form-control" name="danhmuc">
                                    <option value="">Chọn danh mục</option>
                                    <?php 
                                    require('../db/conn.php');
                                    $sql_str = "SELECT * FROM categories ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thương hiệu:</label>
                                <select class="form-control" name="thuonghieu">
                                    <option value="">Chọn thương hiệu</option>
                                    <?php 
                                    $sql_str = "SELECT * FROM brands ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-success" type="submit">Tạo mới</button>
                        </form>
                        <script>
                        function validateForm() {
                            var name = document.forms["addAccountForm"]["name"].value;
                            var sumary = document.forms["addAccountForm"]["sumary"].value;
                            var description = document.forms["addAccountForm"]["description"].value;
                            var stock = document.forms["addAccountForm"]["stock"].value;
                            var giagoc = document.forms["addAccountForm"]["giagoc"].value;
                            var giaban = document.forms["addAccountForm"]["giaban"].value;
                            var thuonghieu = document.forms["addAccountForm"]["thuonghieu"].value;
                            var danhmuc = document.forms["addAccountForm"]["danhmuc"].value;

                            if (name == "") {
                                alert("Vui lòng nhập tên sản phẩm");
                                return false;
                            }

                            if (sumary == "") {
                                alert("Vui lòng nhập tóm tắt sản phẩm");
                                return false;
                            }
                            if (description == "") {
                                alert("Vui lòng nhập mô tả");
                                return false;
                            }
                            if (stock == "") {
                                alert("Vui lòng nhập số lượng");
                                return false;
                            }
                            if (giagoc == "") {
                                alert("Vui lòng nhập giá gốc");
                                return false;
                            }
                            if (giaban == "") {
                                alert("Vui lòng nhập giá bán");
                                return false;
                            }
                            if (thuonghieu == "") {
                                alert("Vui lòng chọn thương hiệu");
                                return false;
                            }
                            if (danhmuc == "") {
                                alert("Vui lòng chọn danh mục");
                                return false;
                            }
                            return true;
                        }
                        </script>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require('includes/footer.php');
?>