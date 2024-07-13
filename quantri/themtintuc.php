<?php
require('includes/header.php');
?>

<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm mới tin tức</h1>
                        </div>
                        <form name="addAccountForm" class="user" method="post" action="addnews.php"
                            enctype="multipart/form-data" onsubmit="return validateForm()">
                            <div class="form-group">
                                <label class="form-label">Tiêu đề tin tức</label>
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    aria-describedby="emailHelp" placeholder="Tiêu đề tin tức">
                            </div>

                            <div class="form-group">
                                <label class="form-label">Hình đại diện cho tin</label>
                                <input type="file" class="form-control form-control-user" id="anh" name="anh">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt tin:</label>
                                <textarea name="sumary" class="form-control" placeholder="Nhập..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Nội dung tin:</label>
                                <textarea name="description" class="form-control" placeholder="Nhập..."></textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục tin:</label>
                                <select class="form-control" name="danhmuc">
                                    <option value="">Chọn danh mục</option>
                                    <?php
                                    require('../db/conn.php');
                                    $sql_str = "SELECT * FROM newscategories ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Tạo mới</button>
                        </form>
                        <script>
                        function validateForm() {
                            var name = document.forms["addAccountForm"]["name"].value;
                            var sumary = document.forms["addAccountForm"]["sumary"].value;
                            var description = document.forms["addAccountForm"]["description"].value;
                            var danhmuc = document.forms["addAccountForm"]["danhmuc"].value;
                            var anh = document.forms["addAccountForm"]["anh"].value;

                            if (name == "") {
                                alert("Vui lòng nhập tiêu đề tin tức");
                                return false;
                            }
                            if (anh == "") {
                                alert("Vui lòng chọn ảnh tin tức");
                                return false;
                            }
                            if (sumary == "") {
                                alert("Vui lòng nhập tóm tắt tin tức");
                                return false;
                            }
                            if (description == "") {
                                alert("Vui lòng nhập nội dung tin tức");
                                return false;
                            }
                            if (danhmuc == "") {
                                alert("Vui lòng chọn danh mục tin tức");
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