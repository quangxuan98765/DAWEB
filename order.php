<!DOCTYPE html>
<html lang="vi">
<?php
require_once('lib_login_session.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LaptrinhWeb2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM donhang";
$result = mysqli_query($conn, $sql);
$count = 0;
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/sigup.css">
    <link rel="stylesheet" href="css/admin1.css">

</head>
<body>
    <img src="img/loader.gif" class="loader" alt="">

    <div class="alert-box">
        <img src="img/error.png" class="alert-img" alt="">
        <p class="alert-msg">Thông báo lỗi</p>
    </div>
    <img src="img/dark-logo.png" class="logo" alt="">

    <!--become seller element-->
    <!--apply form-->
    <div class="nav-space">
        <div class="nav-admin">
            <img src="img/user.png">
            <?php
                echo '<p class="add-product-title name-admin">Hello '. $_SESSION['current_username'] .'</p>';
                echo '<button class="btn btn-new-product" id="new-product">Đăng xuất</button>';
            ?>
            <script>
                var logoutBtn = document.getElementById("new-product");

                logoutBtn.addEventListener("click", function() {
                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'unset_lib_login_session.php', true);

                    xhr.onload = function() {
                        //var response = JSON.parse(this.responseText);
                        if (this.responseText === 'ok') {
                            window.location.replace('index.php'); //phương thức location.replace thì trang web sẽ không back lại được
                        }
                    };

                    xhr.send();
                });
            </script>
            
        </div>
        <p class="add-product-title nav-link" onclick="location.href='user.html'">quản lý user</p>
        <p class="add-product-title nav-link" onclick="location.href='order.php'">quản lý đơn hàng</p>
        <p class="add-product-title nav-link" onclick="location.href='report.html'">báo cáo</p>
        <p class="add-product-title nav-link" onclick="location.href='orderdetail.html'">xem đơn chi tiết</p>
    </div>
    <div class="order-list">
        <div class="add-product">
            <p class="add-product-title">quản lý đơn hàng</p>
        </div>
        <div class="box">
            <div class="date-search">
                    <a class="nameselect-combo">Từ ngày</a>
                    <input type="date" class="date">
                    <a class="nameselect-combo">Tới ngày</a>
                    <input type="date" class="date">
                <div class="btn-search-date">
                    <button class="btn btn-search-date">Xác nhận</button>
                </div>
            </div>
        </div>
        <h2>Danh sách đơn hàng</h2>
        <div class="box">
            <select class="select">
                <option>hiển thị: 10 mục</option>
                <option>20</option>
                <option>30</option>
                <option>tất cả</option>
            </select>
            <select class="select">
                <option>Sếp theo: Trạng thái</option>
                <option>Đã xử lý</option>
                <option>chưa xử lý</option>
                <option>đã xác nhận</option>
                <option>đã huỷ</option>
                <option>Mới nhất</option>
                <option>cũ nhất</option>
                <option>thành tiền</option>
            </select>
            <div class="search-order">
                <input type="text" placeholder="Tìm kiếm...">
                <button class="search-btn">&#9906; Tìm kiếm</button>                       
            </div>
        </div>
        <div class="small-container oder-page">
            <table>
                <tr>
                    <th>#</th>
                    <th>Mã đơn hàng</th>
                    <th>Khách Hàng</th>
                    <th>Thời gian</th>
                    <th>Thành tiền</th>
                    <th>Hình thức thanh toán</th>
                    <th>Tình trạng đơn</th>
                    <th>Hành động</th>
                </tr>
                <?php
                    if(mysqli_num_rows($result) > 0){
                        $s = "";
                        while($row = mysqli_fetch_assoc($result)) {
                            $count++;
                            $s .= '<tr><td><a>' . $count . '</a></td>';
                            $s .= sprintf('<td><p class="see-full">%s</p></td>',$row['id']);
                            $s .= sprintf('<td><p>%s</p></td>',$row['tentaikhoan']);
                            $s .= sprintf('<td><a>%s</a></td>',$row['date']);
                            $s .= sprintf('<td><a>500</a></td>');
                            $s .= sprintf('<td><a>%s</a></td>',$row['payment']);
                            $s .= sprintf('<td><a>%s</a></td>',$row['trangthai']);
                            $s .= '<td><button class="cancel-btn">Huỷ</button><button class="confirm-btn">Xác nhận</button></td></tr>';
                        }
                        echo $s;
                    }
                ?>
            </table>
        </div>
        <div class="box">
            <a>Đang hiển thị trang 1 trên 999</a>
            <div class="pre-next-btn">
                <a class="btn">Trang trước</a>
                <a class="btn">1</a>
                <a class="btn">Trang sau</a>
            </div>
        </div>
    </div>

    <script src="js/admin.js"></script>
</body>
</html>