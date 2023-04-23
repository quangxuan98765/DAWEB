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
$taikhoan = $_SESSION['current_username'];
$sql = "SELECT * FROM cart,sanpham WHERE cart.masp = sanpham.MaSP and taikhoan = '$taikhoan'";
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
    <li class="link-item"><a href="laptopProduct.php" class="link">Laptop</li>
    <li class="link-item"><a href="womenarmor.html" class="link">Phụ Kiện</li>
</ul>
<script>
    const userImageButton = document.getElementById("user-img");
    const userPop = document.querySelector('.login-logout-popup');
    userImageButton.addEventListener('click', () =>{
        userPop.classList.toggle('hide');
    })
</script>
<!--         ajax           -->
<script>
    function deleteCart(masp) {
        // Tạo đối tượng XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "deleteCart.php?masp=" + masp, true);
        xhr.onload = function() {
            var products = JSON.parse(xhr.responseText);
            var productContainer = document.getElementById('boxajax-containter');
            var productHtml = `<a class="back" onclick="location.href='index.php'">&larr; Mua thêm sản phẩm khác</a> <div class="small-container cart-page"><table><tr><th>Sản phẩm</th><th>Số lượng</th><th style="width: 130px">giá</th></tr>`;
            if(products.length === 0) {
                productContainer.innerHTML = `Giỏ hàng của bạn đang trống`;
            }
            else{
                products.forEach(function(product){
                    productHtml += `<tr><td><div class="cart-info"><img src="` + product.HinhSP + `"><div>`;
                    productHtml += `<h3>` + product.TenSP + `</h3>`;
                    productHtml += `<small>`+ product.MoTaSP +`</small><br>`;
                    productHtml += `<a class="link-text" href="product.php?MaSP=` + product.masp + `">Xem chi tiết</a><br>`;
                    var gia = parseInt(product.GiaSP);
                    productHtml += `<button class="btn-remove" onclick="deleteCart('${product.masp}')">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="${product.soluong}"><button class="btn-value">+</button></td><td>`+ gia.toLocaleString('vi-VN') +`₫</td></tr>`;
                });
                productContainer.innerHTML = productHtml;
            }
        }
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send();
    }
</script>
<div id="boxajax-containter">
    <a class="back" onclick="location.href='index.php'">&larr; Mua thêm sản phẩm khác</a> 
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th style="width: 130px">giá</th>
            </tr>
            <?php
            if(mysqli_num_rows($result) > 0){
                $s = "";
                while($row = mysqli_fetch_assoc($result)) {
                    $s.=sprintf('<tr><td><div class="cart-info"><img src="%s"><div>',$row['HinhSP']);
                    $s.=sprintf('<h3>%s</h3>',$row['TenSP']);
                    $s.=sprintf('<small>%s</small><br>',$row['MoTaSP']);
                    $s.='<a class="link-text" href="product.php?MaSP=' . $row['masp'] .'">Xem chi tiết</a><br>';
                    $s.=sprintf('<button class="btn-remove" onclick="deleteCart(\'%s\')">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="%s"><button class="btn-value">+</button></td><td>%s₫</td></tr>',$row['masp'],$row['soluong'],number_format($row['GiaSP'], 0, '', '.'));
                }
                echo $s;
            }
            else {
                echo 'Giỏ hàng của bạn đang trống';
            }
            ?>
        </table>
    </div>
</div>
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
        <a href="locationForm.html" class="link">Thêm địa chỉ</a>
        <script>
            function redirectToPage() {
                var selectBox = document.getElementById("mySelect");
                var selectedValue = selectBox.options[selectBox.selectedIndex].value;
                if (selectedValue !== "") {
                    window.location.href = 'editlocationForm.php?id=' + selectedValue;
                }
            }
        </script>
        <div class="address-input">
        <select id="mySelect" onchange="redirectToPage()" class="select">
            <option>Chọn địa chỉ</option>
            <?php
            $sql1 = "SELECT * FROM diachi WHERE taikhoan = '$taikhoan'";
            $result1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($result1) > 0){
                while($row1 = mysqli_fetch_assoc($result1)) {
                    echo '<option value="' .$row1['id'] . '">' . $row1['city'] . ' ' . $row1['tenduong'] . ' ' . $row1['sonha'] . '</option>';
                }
            }
            ?>
        </select>
        </div>
        <input type="text" class="input-text input-text3" placeholder="Yêu cầu khác (không bắt buộc)">
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