<!DOCTYPE html>
<html lang="vi">
<?php
require_once('lib_login_session.php');
?>
<?php
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
$sql = "SELECT * FROM cart";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/cart.css">

</head>
<body>
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/searchIndex.css">
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
                                        window.location.reload();
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
            <a href="historycart.html"><img src="img/history.png"></a>
            <a href="cart.php"><img src="img/cart.png"></a>
    </div>
</div>
<ul class="links-container">
    <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
    <li class="link-item"><a href="womenarmor.html" class="link">women armor</li>
    <li class="link-item"><a href="menarmor.php" class="link">man armor</li>
    <li class="link-item"><a href="accessories.html" class="link">phụ kiện</li>
    <li class="link-item"><a href="product.html" class="link">sản phẩm</li>
    <li class="link-item"><a class="link"></li>
</ul>
<script>
    const userImageButton = document.getElementById("user-img");
    const userPop = document.querySelector('.login-logout-popup');
    userImageButton.addEventListener('click', () =>{
        userPop.classList.toggle('hide');
    })
</script>
    <a class="back" onclick="location.href='index.php'">&larr; Mua thêm sản phẩm khác</a> 
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th style="width: 130px">giá</th>
            </tr>
            <script>
                function deleteCart(masp) {
                    // Tạo đối tượng XMLHttpRequest
                    var xhr = new XMLHttpRequest();
                    xhr.open("GET", "deleteCart.php", true);
                    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xhr.send("masp=" + masp);
                }
            </script>
            <?php
            if(mysqli_num_rows($result) > 0){
                $s = "";
                while($row = mysqli_fetch_assoc($result)) {
                    $s.=sprintf('<tr><td><div class="cart-info"><img src="%s"><div>',$row['hinhsp']);
                    $s.=sprintf('<h3>%s</h3>',$row['tensp']);
                    $s.=sprintf('<small>%s</small><br>',$row['motasp']);
                    $s.='<a class="link-text" href="product.php?MaSP=' . $row['masp'] .'">Xem chi tiết</a><br>';
                    $s.=sprintf('<button class="btn-remove" onclick="deleteCart(\'%s\')">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="1"><button class="btn-value">+</button></td><td>%s₫</td></tr>',$row['masp'],number_format($row['giasp'], 0, '', ','));
                }
                echo $s;
            }
            else {
                echo 'Giỏ hàng của bạn đang trống';
            }
            ?>
        </div>
    </table>
    <div class="line"></div>
    <div class="input-cart">
        <p class="text header">thông tin khách hàng</p>
        <input type="checkbox" id="Nam">
        <label for="Nam" class="check-title">Anh</label>
        <input type="checkbox" id="Nu">
        <label for="Nu" class="check-title">Chị</label>
        <div class="zone-text-input">
            <input type="text" class="input-text" placeholder="Họ và tên">
            <input type="text" class="input-text" placeholder="Số điện thoại">
        </div>
        <p class="text header">chọn cách thức nhận hàng</p>
        <input type="checkbox" id="ship">
        <label for="ship" class="check-title">Giao hàng tận nơi</label>
        <input type="checkbox" id="shop">
        <label for="shop" class="check-title">Nhận tại cửa hàng</label>
        <div class="address-input">
            <select class="select">
                <option>Hồ Chí Minh</option>
                <option>Hà Nội</option>
                <option>Mặt Trăng</option>
                <option>Sao Hoả</option>
            </select>
            <select class="select">
                <option>Chọn Quận/Huyện</option>
                <option>Hà Nội</option>
                <option>Mặt Trăng</option>
                <option>Sao Hoả</option>
            </select>
            <select class="select">
                <option>Phường /xã</option>
                <option>Hà Nội</option>
                <option>Mặt Trăng</option>
                <option>Sao Hoả</option>
            </select>
            <input type="text" class="input-text input-text2" placeholder="Số nhà, tên đường">
        </div>
        <input type="text" class="input-text input-text3" placeholder="Yêu cầu khác (không bắt buộc)">
        <div class="check-one-line">
            <input type="checkbox" id="none">
            <label for="none" class="check-title">Gọi người khác nhận hàng (nếu có)</label>
        </div>
        <div class="check-one-line">
            <input type="checkbox" id="none">
            <label for="none" class="check-title">Hướng dẫn sử dụng, giải đáp thắc mắc</label>
        </div>
        <div class="check-one-line">
            <input type="checkbox" id="none">
            <label for="none" class="check-title">xuất hoá đơn công ty</label>
        </div>
        <div class="check-one-line">
            <a class="check-title">*Bạn có thể chọn hình thức thanh toán sau khi đặt hàng</a>
        </div>
    </div>
    <div class="total-price">
        <table>
            <tr>
                <td>Tạm tính (3 sản phẩm)</td>
                <td>790.000₫</td>
            </tr>
            <tr>
                <td><select class=" select select3">
                    <option>Sử dụng mã giảm giá</option>
                    <option>Có cái nịt</option>
                    <option>Mặt Trăng</option>
                    <option>Sao Hoả</option>
                </select></td>
                <td>-0₫</td>
            </tr>
            <tr>
                <td>Tổng thanh toán</td>
                <td>869.000₫</td>
            </tr>
            <tr>
                <td></td>
                <td><button class="btn-cart">Đặt hàng</td>
            </tr>
        </table>
    </div>
    <script src="js/nav.js"></script>
</body>
</html>