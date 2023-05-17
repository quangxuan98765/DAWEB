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
$sql = "SELECT * FROM users,cart,sanpham WHERE  cart.masp = sanpham.MaSP and taikhoan = username and taikhoan = '$taikhoan'";
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
                                    if (this.responseText.trim() === 'ok') {
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
            var sum = 0;
            var billcontainer = document.getElementById('myTD');
            var billcontainer1 = document.getElementById('myTD1');
            var count = document.getElementById('count');
            var products = JSON.parse(xhr.responseText);
            var numOfItems = products.length;
            var productContainer = document.getElementById('boxajax-containter');
            var productHtml = "";
            if(products.length === 0) {
                productHtml = `<a class="back" onclick="location.href='index.php'">&larr; Mua thêm sản phẩm khác</a>`;
                productContainer.innerHTML = productHtml + `<div class="container" style="text-align:center;"><img src="img/no-products.png" alt=""><p class="overlay" id="formtt">Giỏ hàng của bạn đang trống</p></div>`;
                const myForm = document.getElementById("my-form");
                myForm.style.display = "none";
            }
            else{
                products.forEach(function(product){
                    productHtml += `<tr><td><div class="cart-info"><img src="` + product.HinhSP + `"><div>`;
                    productHtml += `<h3>` + product.TenSP + `(` + product.MaSP + `)</h3>`;
                    productHtml += `<small>`+ product.MoTaSP +`</small><br>`;
                    productHtml += `<a class="link-text" href="product.php?MaSP=` + product.masp + `">Xem chi tiết</a><br>`;
                    var gia = parseInt(product.GiaSP) * parseInt(product.soluong);
                    productHtml += `<button class="btn-remove" onclick="deleteCart('${product.masp}')">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="${product.soluong}"><button class="btn-value">+</button></td><td>`+ gia.toLocaleString('vi-VN') +`₫</td></tr>`;
                    sum += gia;
                });
                productContainer.innerHTML = productHtml;
            }
            billcontainer.innerHTML = sum;
            billcontainer1.innerHTML = sum;
            count.innerHTML = `Tạm tính(` + numOfItems + ` sản phẩm)`;
        }
        xhr.onerror = function() {
            console.error(xhr.statusText);
        };
        xhr.send();
    }
</script>
<div id="boxajax-containter">
    <a class="back" onclick="location.href='index.php'">&larr; Mua thêm sản phẩm khác</a>

            <?php
            if(mysqli_num_rows($result) > 0){
                $s = '<div class="small-container cart-page"><table><tr><th>Sản phẩm</th><th>Số lượng</th><th style="width: 130px">giá</th></tr>';
                while($row = mysqli_fetch_assoc($result)) {
                    $name = $row['fullname'];
                    $gia_moi = $row['GiaSP'] * $row['soluong'];
                    $gia_moi = number_format($gia_moi, 0, '', '.'); // Định dạng lại giá mới để hiển thị
                    $s.=sprintf('<tr><td><div class="cart-info"><img src="%s"><div>',$row['HinhSP']);
                    $s.=sprintf('<h3>%s (%s)</h3>',$row['TenSP'], $row['MaSP']);
                    $s.=sprintf('<small>%s</small><br>',$row['MoTaSP']);
                    $s.='<a class="link-text" href="product.php?MaSP=' . $row['masp'] .'">Xem chi tiết</a><br>';
                    $s.=sprintf('<button class="btn-remove" onclick="deleteCart(\'%s\')">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="%s"><button class="btn-value">+</button></td><td>' . $gia_moi . '₫</td></tr>',$row['masp'],$row['soluong']);
                }
                $s.='</table></div>';
                echo $s;
            }
            else {
                echo '<div class="container" style="text-align:center;"><img src="img/no-products.png" alt=""><p class="overlay" id="formtt">Giỏ hàng của bạn đang trống</p></div>';
            }
            ?>
</div>
    <form name="form" method="get" id="my-form" action="thanhtoan.php" enctype="multipart/form-data">
    <div class="input-cart">
        <p class="text header">thông tin khách hàng</p>
        <input type="checkbox" id="Nam" name="xungho" onclick="checkOnlyOne1(this)">
        <label for="Nam" class="check-title">Anh</label>
        <input type="checkbox" id="Nu" name="xungho" onclick="checkOnlyOne1(this)">
        <label for="Nu" class="check-title">Chị</label>
        <div class="zone-text-input">
        <?php  echo '<input id="hoten"  type="text" class="input-text" placeholder="Họ và tên" value="'.$name.'"'?>>
            <input id="sdt" name="sdt" type="text" class="input-text" placeholder="Số điện thoại">
        </div>
        <p class="text header">chọn địa chỉ nhận hàng</p>

        <a href="locationForm.html" class="linked" >Thêm địa chỉ mới</a>
        <div class="address-input">
        <select id="mySelect" name="select-loc" class="select">
            <option value="-1">Chọn địa chỉ nhận hàng</option>
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
        <a id="myLink" href="#">Chỉnh sửa địa chỉ</a>
        </div>
        <input type="text" class="input-text input-text3" placeholder="Yêu cầu khác (không bắt buộc)">
        <p class="text header">chọn phương thức thanh toán</p>
        <input type="checkbox" id="cod" name="pay" value="COD" onclick="checkOnlyOne2(this)">
        <label for="cod" class="check-title">COD</label>

        <input type="checkbox" id="onl" name="pay" value="Online" onclick="checkOnlyOne2(this)">
        <label for="onl" class="check-title">Online</label>
        <div class="zone-text-input">
            <input type="text" class="input-text" id="bank" placeholder="số tài khoản" style="display:none;">
        </div>

    </div>
    <div class="total-price" id="billajax">
        <table>
            <tr>
                <?php
                $sql1 = "SELECT SUM(sanpham.GiaSP * cart.soluong) as tong_gia 
                FROM cart 
                INNER JOIN sanpham ON cart.masp = sanpham.MaSP 
                WHERE cart.taikhoan = '$taikhoan';";
                $result1 = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result1);
                $sum = $row['tong_gia'];
                $sum = number_format($sum, 0, '', '.'); // Định dạng lại giá mới để hiển thị
                $count = mysqli_num_rows($result);
                echo '<td id="count">Tạm tính(' . $count . 'sản phẩm)</td>';
                echo '<td id="myTD">' . $sum . '</td>';
                echo '</tr><tr><td><select class=" select select3"><option>Sử dụng mã giảm giá</option><option>Có cái nịt</option></select></td><td>-0₫</td></tr><tr><td>Tổng thanh toán</td>';
                echo '<td id="myTD1">' . $sum . '</td>';
                ?>
            </tr>
            <tr>
                <td></td>
                <td><button name="dathang" class="btn-cart" onclick="return validateForm()">Đặt hàng</td>
            </tr>
        </table>
    </div>
    </form>
    <script src="js/cart.js"></script>
</body>
</html>