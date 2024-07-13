<?php 
require('includes/header.php');
?>



<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate
        Report</a>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Doanh thu (Hàng tháng)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            $40,000
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Doanh thu (Hàng năm)
                        </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                require('../db/conn.php');
                                $sql_str1 = "SELECT * FROM `order_details`";
                                        $result1 = mysqli_query($conn, $sql_str1);
                                        
                                        $total_price = 0; // Khởi tạo biến để tính tổng giá tiền
                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                            $total_price += $row1['price'] * $row1['qty']; // Tính tổng giá tiền
                                        }
                                
                               
                                    echo number_format($total_price, 0, '', '.') . " VNĐ";
                             

                                // Đóng kết nối
                                mysqli_close($conn);
                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-danh-muc-san-pham"
                            class="text-xs font-weight-bold text-info text-uppercase mb-1">
                            Số lượng thể loại sản phẩm
                        </a>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                    <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from categories";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-thuong-hieu-san-pham"
                            class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Số lượng thương hiệu sản phẩm
                        </a>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from brands";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-san-pham" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số lượng sản phẩm
                        </a>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from products";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-danh-muc-tin-tuc"
                            class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số lượng thể loại tin tức
                        </a>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from newscategories";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-tin-tuc" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số lượng tin tức
                        </a>
                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from news";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-dach-don-hang" class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Số lượng đơn hàng
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php 
                                      require('../db/conn.php');
                                      $sql_str = "SELECT count(*) as count from orders";
                                      $result = mysqli_query($conn, $sql_str);
                                      
                                      // Kiểm tra nếu truy vấn thành công
                                      if ($result) {
                                          // Lấy hàng kết quả đầu tiên
                                          $row = mysqli_fetch_assoc($result);
                                          // In ra giá trị đếm
                                          echo $row['count'];
                                      } else {
                                          echo "Lỗi: " . mysqli_error($conn);
                                      }

                                      // Đóng kết nối
                                      mysqli_close($conn);
                                  ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <form action="loc-don-hang" method="post">
                            <input type="hidden" name="selectStatus" value="Processing">
                            <button type="submit" name="btnLocOrder"
                                class="btn_link_dashboard text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng đơn hàng đang xử lý
                            </button>
                        </form>

                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from orders where status='processing'";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                            </div>

                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <form action="loc-don-hang" method="post">
                            <input type="hidden" name="selectStatus" value="Confirmed">
                            <button type="submit" name="btnLocOrder"
                                class="btn_link_dashboard text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng đơn hàng đã xác nhận
                            </button>
                        </form>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from orders where status='Confirmed'";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <form action="loc-don-hang" method="post">
                            <input type="hidden" name="selectStatus" value="Shipping">
                            <button type="submit" name="btnLocOrder"
                                class="btn_link_dashboard text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng đơn hàng đang giao
                            </button>
                        </form>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from orders where status='Shipping'";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <form action="loc-don-hang" method="post">
                            <input type="hidden" name="selectStatus" value="Cancelled">
                            <button type="submit" name="btnLocOrder"
                                class="btn_link_dashboard text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng đơn hàng đã bị huỷ
                            </button>
                        </form>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from orders where status='Cancelled'";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <form action="loc-don-hang" method="post">
                            <input type="hidden" name="selectStatus" value="Delivered">
                            <button type="submit" name="btnLocOrder"
                                class="btn_link_dashboard text-xs font-weight-bold text-success text-uppercase mb-1">
                                Số lượng đơn hàng đã giao
                            </button>
                        </form>

                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from orders where status='Delivered'";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <a href="danh-sach-tai-khoan" class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Số lượng tài khoản
                        </a>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                            <?php 
                                  require('../db/conn.php');
                                  $sql_str = "SELECT count(*) as count from admins";
                                  $result = mysqli_query($conn, $sql_str);
                                  
                                  // Kiểm tra nếu truy vấn thành công
                                  if ($result) {
                                      // Lấy hàng kết quả đầu tiên
                                      $row = mysqli_fetch_assoc($result);
                                      // In ra giá trị đếm
                                      echo $row['count'];
                                  } else {
                                      echo "Lỗi: " . mysqli_error($conn);
                                  }

                                  // Đóng kết nối
                                  mysqli_close($conn);
                              ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Row -->





<?php
require('includes/footer.php');
?>