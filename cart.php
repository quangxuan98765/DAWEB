<!DOCTYPE html>
<html lang="vi">

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
    
    <nav class="navbar"></nav>
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
                    $s.=sprintf('<tr><td><div class="cart-info"><img src="%s"><div>',$row['hinhsp']);
                    $s.=sprintf('<h3>%s</h3>',$row['tensp']);
                    $s.=sprintf('<small>%s</small><br>',$row['motasp']);
                    $s.='<a class="link-text" href="product.php?id=' . $row['id'] .'">Xem chi tiết</a><br>';
                    $s.='<button class="btn-remove">Xoá sản phẩm</button></div></div><td><button class="btn-value">-</button><input type="number" value="1"><button class="btn-value">+</button></td><td>230.000₫</td></tr>';
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