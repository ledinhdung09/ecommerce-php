<?php 


//lay id goi edit
$id = $_GET['id'];

//tim trong CSDL brand co id trung
//ket noi csdl
require('../db/conn.php');

$sql_str = "SELECT * FROM admins WHERE id=$id";
$res = mysqli_query($conn, $sql_str);

$admins = mysqli_fetch_assoc($res);

if (isset($_POST['btnUpdate'])){
    //neu nut Cap nhat duoc nhan
    //lay name
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $type = $_POST['type'];

    // Sử dụng Prepared Statements để cập nhật dữ liệu
    $stmt = $conn->prepare("UPDATE admins SET name=?, email=?, phone=?, address=?,status=?,role=? WHERE id=?");
    $stmt->bind_param("ssssssi", $name, $email, $phone, $address,$status,$type, $id);

    // Thực hiện truy vấn
    if ($stmt->execute() === false) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }
    // Đóng câu lệnh
    $stmt->close();

    //chuyen qua trang listaccount
    header("Location: ../danh-sach-tai-khoan");
    exit();
} else {
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
                            <h1 class="h4 text-gray-900 mb-4">Cập nhật tài khoản (admin)</h1>
                        </div>
                        <form class="user" method="post" action="">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control form-control-user" id="name" name="name"
                                    type="text" placeholder="Tên người dùng" value="<?php echo $admins['name']?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" aria-describedby="emailHelp" class="form-control form-control-user"
                                    id="email" name="email" placeholder="Email" value="<?php echo $admins['email']?>">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" class="form-control form-control-user" id="phone" name="phone"
                                    placeholder="Phone" value="<?php echo $admins['phone']?>">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-user" id="address" name="address"
                                    placeholder="Địa chỉ" value="<?php echo $admins['address']?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Trạng thái</label>
                                <select class="form-control" name="status">
                                    <option>Chọn danh mục</option>
                                    <option value="Active" <?php
                                                if ("Active" == $admins['status'])
                                                    echo "selected";
                                            ?>>Active</option>
                                    <option value="Inactive" <?php
                                                if ("Inactive" == $admins['status'])
                                                    echo "selected";
                                            ?>>Inactive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Quyền</label>
                                <select class="form-control" name="type">
                                    <option>Chọn danh mục</option>
                                    <option value="Admin" <?php
                                                if ("Admin" == $admins['role'])
                                                    echo "selected";

                                            ?>>Admin</option>
                                    <option value="User" <?php
                                                if ("User" == $admins['role'])
                                                    echo "selected";

                                            ?>>User</option>

                                </select>
                            </div>
                            <button class="btn btn-success" name="btnUpdate">Cập nhật</button>
                        </form>
                        <hr>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<?php
require('includes/footer.php');
}
?>