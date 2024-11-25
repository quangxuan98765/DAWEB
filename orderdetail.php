<!DOCTYPE html>
<html lang="vi">
<?php
require_once('lib_login_session.php');
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
    <link rel="stylesheet" href="css/page.css">

</head>
<body>
    <img src="img/loader.gif" class="loader" alt="">

    <div class="alert-box">
        <img src="img/error.png" class="alert-img" alt="">
        <p class="alert-msg"></p>
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
        <p class="add-product-title nav-link" onclick="location.href='index.php'">trang chủ</p>
        <p class="add-product-title nav-link" onclick="location.href='userhtml.php'">quản lý user</p>
        <p class="add-product-title nav-link" onclick="location.href='order.php'">quản lý đơn hàng</p>
    </div>

    <div class="list-orderdetail">
        <div class="add-product">
            <p class="add-product-title">Chi tiết đơn hàng</p>
        </div>
        
        <div class="info-order">
            <p>Tên khách hàng:</p>
            <p>Số điện thoại: </p>
            <p>Thời gian đặt: </p>
            <p>Địa chỉ: </p>
            <p>Hành động: </p>
            <p>Hình thức thanh toán: </p>
            <p>Trạng thái thanh toán: </p>
            <p>Trạng thái đơn hàng: </p>
            <p>Ghi chú: không có</p>
            <button class="btn report">In thông tin đơn hàng</button>
        </div>
        <div class="small-container cart-page">
            <table>
                <tr>
                    <th>Sản phẩm</th>
                    <th class="number-pro">Số lượng</th>
                    <th class="cost">giá</th>
                </tr>
                <tr>
                    <td>
                        <div class="cart-info">
                            <img src="">
                            <div>
                                <h3></h3>
                                <small></small>
                            </div>
                        </div>
                    <td><a></a></td>
                    <td></td>
                </tr>
      
            
        </table>
    </div>
        <div class="total-price">
                <table>
                        <tr>
                            <td>Tổng giá sản phẩm</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Vận chuyển</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Mã giảm giá</td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>Tổng thanh toán</td>
                            <td></td>
                        </tr>
                </table>
            </div>
    </div>
</body>

<script>
const id_dh = new URLSearchParams(window.location.search).get("id" );
    if(id_dh != null && id_dh !=""){
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "orderdetailRequest.php?id_dh=" + id_dh , true);
        xhr.onload = function () {       
        if (xhr.status == 200) {
            var data = JSON.parse(xhr.responseText);
            var text = "";

            text +=`<div class="add-product">
            <p class="add-product-title">Chi tiết đơn hàng #` + data[0].id+`</p></div><div class="info-order">
            <p>Tên khách hàng: `+data[0].fullname+`</p>
            <p>Số điện thoại:`+ data[0].sdt+`</p>
            <p>Thời gian đặt: `+data[0].date+`</p>
            <p>Địa chỉ: `+ data[0].sonha + " " +data[0].tenduong +", "+data[0].city+`</p>
            <p>Hành động: ` +(data[0].trangthai=="waiting"?"Chưa xác nhận" :(data[0].trangthai == "cancelled"?"Đã hủy":"Đã xác nhận"))+`</p>
            <p>Hình thức thanh toán: `+data[0].payment+`</p>
            <p>Trạng thái thanh toán: </p>
            <p>Trạng thái đơn hàng: </p>
            <p>Ghi chú: không có</p>
            <button class="btn report">In thông tin đơn hàng</button>
        </div> <div class="small-container cart-page"><table><tr><th>Sản phẩm</th> <th class="number-pro">Số lượng</th><th class="cost">giá</th></tr>`;
            var TongGia = 0;
            data.forEach((e) => {
                var gia = parseInt(e.soluong * e.GiaSP);
                TongGia += parseInt(gia);
                text+= `<tr><td><div class="cart-info">
                            <img src="`+e.HinhSP+`"><div>
                                <h3>`+e.TenSP+`</h3>
                                <small>`+e.MoTaSP+`</small> </div></div>
                    <td><a>`+e.soluong+`</a></td>
                    <td>`+ gia.toLocaleString('vi-VN') +` USD</td> </tr>`;
            });
            text+=`</table></div><div class="total-price"><table><tr>
                            <td>Tổng giá sản phẩm</td>
                            <td>`+TongGia.toLocaleString('vi-VN')+` USD</td></tr><tr>
                            <td>Vận chuyển</td><td>50.000 USD</td></tr> <tr>
                            <td>Mã giảm giá</td>
                            <td></td></tr><tr>
                            <td>Tổng thanh toán</td>
                            <td>`+(TongGia+50000).toLocaleString('vi-VN')+` USD</td></tr></table></div>`;
            document.querySelector(".list-orderdetail").innerHTML = text;
        }}
        xhr.send();
    }
</script>

</html>