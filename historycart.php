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
$sql = "SELECT *,donhang.id as did FROM sanpham,donhang WHERE donhang.masp = sanpham.MaSP and donhang.tentaikhoan = '$taikhoan';";
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
                <a href="historycart.html"><img src="img/history.png"></a>
                <a href="cart.php"><img src="img/cart.png"></a>
        </div>
    </div>
    <ul class="links-container">
        <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
        <li class="link-item"><a href="laptopProduct.php" class="link">Laptop</li>
        <li class="link-item"><a href="womenarmor.html" class="link">Phụ Kiện</li>
        <li class="link-item"><a class="link">Phụ Kiện</li>
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
        <div class="search go-right">
            <input type="text" class="search-box" placeholder="">
            <button class="search-btn">&#9906; Tìm kiếm</button>                       
        </div>
        </div>
    </div>

    <script>
    function deleteCart(masp) {
        // Tạo đối tượng XMLHttpRequest
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "thanhtoan.php?id=" + masp + "&huydon=1", true);
        xhr.onload = function() {
            var products = JSON.parse(xhr.responseText);
            var productContainer = document.getElementById('boxajax');
            var productHtml = "";
            if(products.length === 0) {
                productContainer.innerHTML = `Bạn chưa mua gì`;
            }
            else{
                products.forEach(function(product){
                    productHtml += `<table><tr><th>Mã đơn hàng</th><th>Sản phẩm</th><th>Số lượng</th><th>giá</th><th>ngày đặt mua</th><th class="status-confirm">trạng thái</th></tr>`;
                    productHtml += `<tr><td>#` + product.did + `</td><td>`;
                    productHtml += `<div class="cart-info"><img src="` + product.HinhSP + `"><div>`;
                    productHtml += `<h3>` + product.TenSP + ` (`+ product.MaSP + `)</h3>`;
                    productHtml += `<small>` + product.MoTaSP +`</small><br>`;
                    productHtml += `<a class="link-text" href="product.php?MaSP=` + product.masp + `">Xem chi tiết</a></div></div></td>`;
                    var gia = parseInt(product.GiaSP) * parseInt(product.soluong);
                    productHtml += `<td><a>`+ product.soluong +`</a></td><td>` + gia.toLocaleString('vi-VN') + `₫</td>`;
                    productHtml += `<td>`+ product.date +`</td><td><button name="huydon" onclick="deleteCart('${product.did}')">Hủy đơn</button><p>`+ product.trangthai +`</p></td></tr></table>`;
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

    <div class="small-container cart-page" id="boxajax">
            <?php
            if(mysqli_num_rows($result) > 0){
                $s = "";
                while($row = mysqli_fetch_assoc($result)) {
                    $s .= '<table><tr><th>Mã đơn hàng</th><th>Sản phẩm</th><th>Số lượng</th><th>giá</th><th>ngày đặt mua</th><th class="status-confirm">trạng thái</th></tr>';
                    $gia_moi = $row['GiaSP'] * $row['soluong'];
                    $gia_moi = number_format($gia_moi, 0, '', '.');
                    $s .= sprintf('<tr><td>#%s</td><td>',$row['did']);
                    $s .= sprintf('<div class="cart-info"><img src="%s"><div>',$row['HinhSP']);
                    $s .= sprintf('<h3>%s (%s)</h3>',$row['TenSP'], $row['MaSP']);
                    $s .= sprintf('<small>%s</small><br>',$row['MoTaSP']);
                    $s.='<a class="link-text" href="product.php?MaSP=' . $row['MaSP'] .'">Xem chi tiết</a></div></div></td>';
                    $s .= sprintf('<td><a>%s</a></td><td>' . $gia_moi . '₫</td>',$row['soluong'],$row['GiaSP']);
                    $s .= sprintf('<td>%s</td><td><button name="huydon" onclick="deleteCart(\'%s\')">Hủy đơn</button><p>%s</p></td></tr></table>',$row['date'],$row['did'],$row['trangthai']);
                }
                echo $s;
            }
            else {
                echo 'Bạn chưa mua gì';
            }
            ?>
    </div>
    <script src="js/nav.js"></script>
</body>
</html>