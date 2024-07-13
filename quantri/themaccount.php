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
                            <h1 class="h4 text-gray-900 mb-4">Thêm tài khoản (admin)</h1>
                        </div>
                        <form name="addAccountForm" class="user" method="post" action="addaccount.php"
                            onsubmit="return validateForm()">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    type="text" placeholder="Tên người dùng">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" aria-describedby="emailHelp" class="form-control form-control-user"
                                    id="email" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label for="phone">Password</label>
                                <input type="text" class="form-control form-control-user" id="phone" name="password"
                                    placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="phone">Confirm password</label>
                                <input type="text" class="form-control form-control-user" id="phone"
                                    name="confirmpassword" placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                    placeholder="Phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-user" id="address" name="address"
                                    placeholder="Địa chỉ">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option>Chọn danh mục</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quyền</label>
                                <select class="form-control" name="type">
                                    <option>Chọn danh mục</option>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>

                                </select>
                            </div>
                            <button class="btn btn-success" name="btnadd">Thêm</button>
                        </form>
                        <script>
                        function validateForm() {
                            var name = document.forms["addAccountForm"]["name"].value;
                            var email = document.forms["addAccountForm"]["email"].value;
                            var password = document.forms["addAccountForm"]["password"].value;
                            var confirmpassword = document.forms["addAccountForm"]["confirmpassword"].value;
                            var phone = document.forms["addAccountForm"]["phone"].value;
                            var address = document.forms["addAccountForm"]["address"].value;
                            var status = document.forms["addAccountForm"]["status"].value;
                            var type = document.forms["addAccountForm"]["type"].value;

                            if (name == "") {
                                alert("Vui lòng nhập name");
                                return false;
                            }

                            if (email == "") {
                                alert("Vui lòng nhập email");
                                return false;
                            }

                            if (password == "") {
                                alert("Vui lòng nhập password");
                                return false;
                            }

                            if (confirmpassword == "") {
                                alert("Vui lòng nhập confirm password");
                                return false;
                            }

                            if (type == "") {
                                alert("Vui lòng nhập type");
                                return false;
                            }

                            if (address == "") {
                                alert("Vui lòng nhập address");
                                return false;
                            }

                            if (status == "") {
                                alert("Vui lòng chọn trạng thái");
                                return false;
                            }

                            if (type == "") {
                                alert("Vui lòng chọn quyền");
                                return false;
                            }
                            if (password != confirmpassword) {
                                alert("Mật khẩu không khớp");
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