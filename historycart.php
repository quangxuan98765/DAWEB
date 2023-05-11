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
$taikhoan = $_SESSION['current_username'];
$sql = "SELECT *,donhang.id as did FROM sanpham,sl_sp_dh,donhang WHERE donhang.id = id_dh and sanpham.id = id_sp and donhang.tentaikhoan = '$taikhoan';";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử mua hàng</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">
    <link rel="stylesheet" href="css/searchIndex.css">
    
    <link rel="stylesheet" href="css/page.css">

</head>
<body>
    <div class="nav">
        <img src="img/dark-logo.png" class="brand-logo" alt="">
        <div class="nav-items">
                <div class="search">
                    <input type="text" class="search-box" placeholder="Tìm tên thương hiệu, sản phẩm...">
                    <button class="search-btn">Tìm kiếm</button>                       
                </div>
                <a>
                    <img src="img/user.png" id="user-img" alt="">
                    <div class="login-logout-popup hide">
                    <?php
                        if(isLogged() == 0 || isLogged() == 1) {
                            echo "<p class='account-info'>Xin chào, " . $_SESSION['current_username'] . "!</p>";
                            echo ('<button class="btn" id="user-btn">đăng xuất</button>');?>
                            <script>
                                var logoutBtn = document.getElementById("user-btn");
    
                                logoutBtn.addEventListener("click", function() {
                                    var xhr = new XMLHttpRequest();
                                    xhr.open('POST', 'unset_lib_login_session.php', true);
    
                                    xhr.onload = function() {
                                        //var response = JSON.parse(this.responseText);
                                        if (this.responseText === 'ok') {
                                            window.location.href = "index.php";
                                        }
                                    };
    
                                    xhr.send();
                                });
                            </script>
                    <?php
                        }
                        else {
                            echo "<p class='account-info'>bạn chưa đăng nhập</p>";
                            echo ('<button class="btn" id="user-btn">đăng nhập</button>');?>
                            <script>
                                document.getElementById("user-btn").addEventListener("click", function() {
                                    window.location.href = "login.html";
                                });
                            </script>
                    <?php
                        }
                    ?>
                    </div>
                </a>
                <a href="historycart.php"><img src="img/history.png"></a>
                <a href="cart.php"><img src="img/cart.png"></a>
        </div>
    </div>
    <ul class="links-container">
        <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
        <li class="link-item"><a href="laptopProduct.php" class="link">Laptop</li>
        <li class="link-item"><a href="womenarmor.html" class="link">Phụ Kiện</li></a>
    </ul>
    <script>
        const userImageButton = document.getElementById("user-img");
        const userPop = document.querySelector('.login-logout-popup');
        userImageButton.addEventListener('click', () =>{
            userPop.classList.toggle('hide');
        })
    </script>
    <div class="info-user">
        <div class="title-user">
        <h2 class="title-history-cart">Đơn hàng đã mua gần đây</h2>  
        </div>
    </div>

    <div class="small-container cart-page" id="boxajax">
  
    </div>

    <ul class="list_page"></ul>
    <script type="module" src="js/historycart.js"></script>
</body>
</html>