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
            var billcontainer = document.getElementById('billajax');
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
    <form name="form">
    <div class="input-cart">
        <p class="text header">thông tin khách hàng</p>
        <input type="checkbox" id="Nam" name="xungho" onclick="checkOnlyOne1(this)">
        <label for="Nam" class="check-title">Anh</label>
        <input type="checkbox" id="Nu" name="xungho" onclick="checkOnlyOne1(this)">
        <label for="Nu" class="check-title">Chị</label>
        <div class="zone-text-input">
            <input id="hoten" type="text" class="input-text" placeholder="Họ và tên">
            <input id="sdt" type="text" class="input-text" placeholder="Số điện thoại">
        </div>
        <p class="text header">chọn cách thức nhận hàng</p>
        <input type="checkbox" id="ship" name="delivery" onclick="checkOnlyOne(this)">
        <label for="ship" class="check-title">Giao hàng tận nơi</label>

        <input type="checkbox" id="shop" name="delivery" onclick="checkOnlyOne(this)">
        <label for="shop" class="check-title">Nhận tại cửa hàng</label>

        <a href="locationForm.html" class="linked" id="add-address-link">Thêm địa chỉ mới</a>
        <div class="address-input">
        <select id="mySelect" class="select">
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
        <a id="myLink" href="#" style="display:none;">Chỉnh sửa địa chỉ</a>
        </div>
        <input type="text" class="input-text input-text3" placeholder="Yêu cầu khác (không bắt buộc)">
        <p class="text header">chọn phương thức thanh toán</p>
        <input type="checkbox" id="cod" name="pay" onclick="checkOnlyOne2(this)">
        <label for="cod" class="check-title">COD</label>

        <input type="checkbox" id="onl" name="pay" onclick="checkOnlyOne2(this)">
        <label for="onl" class="check-title">Online</label>
        <div class="zone-text-input">
            <input type="text" class="input-text" id="bank" placeholder="số tài khoản" style="display:none;">
        </div>
        </form>
        <script>
            var select = document.getElementById("mySelect");
            var link = document.getElementById("myLink");

            select.addEventListener("change", function() {
            var selectedOption = this.options[this.selectedIndex];
            var selectedValue = selectedOption.value;
            link.href = 'editlocationForm.php?id=' + selectedValue;
        });
        </script>

<script>
    function checkOnlyOne(checkbox) {
        var checkboxes = document.getElementsByName('delivery');
        checkboxes.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    function checkOnlyOne1(checkbox) {
        var checkxh = document.getElementsByName('xungho');
        checkxh.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    function checkOnlyOne2(checkbox) {
        var checkxh = document.getElementsByName('pay');
        checkxh.forEach((item) => {
            if (item !== checkbox) item.checked = false
        })
    }

    var checkbox1 = document.getElementById("ship");
    var checkbox2 = document.getElementById("shop");
    var link1 = document.getElementById("add-address-link");
    var link2 = document.getElementById("mySelect");
    var link3 = document.getElementById("myLink");

    checkbox1.addEventListener('change', function() {
        if (this.checked && !checkbox2.checked) {
            link1.style.display = "block";
            link2.style.display = "inline";
            link3.style.display = "inline-block";
        } else {
            link1.style.display = "none";
            link2.style.display = "none";
            link3.style.display = "none";
        }
        checkOnlyOne(this);
    });

    checkbox2.addEventListener('change', function() {
        if (this.checked && !checkbox1.checked) {
            link1.style.display = "none";
            link2.style.display = "none";
            link3.style.display = "none";
        }
        checkOnlyOne(this);
    });

</script>

<style>
    #add-address-link, #mySelect{
        display: none;
    }
    .linked {
        display: block;
        text-decoration: none;
        margin-top: 10px; /* khoảng cách giữa thẻ a và các checkbox */
        border: 1px solid #ccc; /* độ rộng và màu sắc khung */
        padding: 5px; /* khoảng cách giữa nội dung và khung */
    }
  .select {
    display: inline-block;
    margin-right: 10px;
  }
  #myLink {
    display: inline-block;
    margin: 0;
  }
</style>
        <script>
            var checkbox1 = document.getElementById("ship");
            var checkbox2 = document.getElementById("shop");
            var checkbox3 = document.getElementById("onl");
            var checkbox4 = document.getElementById("cod");
            var link4 = document.getElementById("bank");

            checkbox3.addEventListener('change', function() {
                link4.style.display = checkbox3.checked ? 'inline' : 'none';
                checkOnlyOne2(this);
            });

            checkbox4.addEventListener('change', function() {
                if (this.checked && !checkbox3.checked) {
                    link4.style.display = "none";
                }
                checkOnlyOne2(this);
            });

            function validateForm() {
                var name = document.forms["form"]["hoten"].value;
                var sdt = document.forms["form"]["sdt"].value;
                var pay = document.forms["form"]["bank"].value;
                if (name == "" || sdt == "" || (checkbox3.checked && pay == "" )|| (!checkbox1.checked && !checkbox2.checked) || (!checkbox3.checked && !checkbox4.checked)) {
                    alert("vui long2 dien du tt.");
                    return false;
                }
                if(checkbox1.checked){
                    if(document.getElementById("mySelect").value == -1){
                        alert("vui long2 dien du tt.");
                        return false;
                    }
                }
            }
        </script>

    </div>
    <div class="total-price" id="billajax">
        <table>
            <tr>
                <?php
                $sql1 = "SELECT SUM(GiaSP) as tong_gia FROM cart,sanpham WHERE cart.masp = sanpham.MaSP and taikhoan = '$taikhoan'";
                $result1 = mysqli_query($conn, $sql1);
                $row = mysqli_fetch_assoc($result1);
                $sum = $row['tong_gia'];
                $count = mysqli_num_rows($result);
                echo "<td>Tạm tính( $count sản phẩm)</td>";
                echo "<td>$sum</td>";
                echo '</tr><tr><td><select class=" select select3"><option>Sử dụng mã giảm giá</option><option>Có cái nịt</option><option>Mặt Trăng</option><option>Sao Hoả</option></select></td><td>-0₫</td></tr><tr><td>Tổng thanh toán</td>';
                echo "<td>$sum</td>";
                ?>
            </tr>
            <tr>
                <td></td>
                <td><button class="btn-cart" onclick="return validateForm()">Đặt hàng</td>
            </tr>
        </table>
    </div>
    <script src="js/nav.js"></script>
</body>
</html>