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

$sql = "SELECT * FROM category";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/admin.css">
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
                                var xhr1 = new XMLHttpRequest();
                                xhr1.open('POST', 'unset_lib_login_session.php', true);

                                xhr1.onload = function() {
                                    //var response = JSON.parse(this.responseText);
                                    if (this.responseText === 'ok') {
                                        window.location.reload();
                                    }
                                };

                                xhr1.send();
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
            <?php
                if(isLogged() == 1 || isLogged() == 0){
                    echo '<a href="historycart.php"><img src="img/history.png"></a><a href="cart.php"><img src="img/cart.png"></a>';
                }
            ?>
    </div>
</div>
<ul class="links-container">
    <li class="link-item"><a href="index.php" class="link"><img src="img/home.png">Trang chủ</li>
    <li class="link-item"><a href="laptopProduct.php" class="link">Laptop</li>
    <li class="link-item"><a href="womenarmor.html" class="link">Phụ Kiện</li>
    <?php
        if(isLogged() == 1){
            echo '<li class="link-item"><a href="addProduct.html" class="link">Thêm sản phẩm</li>';
            echo '<li class="link-item"><a href="order.php" class="link">Quản lý Shop</li>';
        }
    ?>
    <li class="link-item"><a class="link"></li>
</ul>
<script>
    const userImageButton = document.getElementById("user-img");
    const userPop = document.querySelector('.login-logout-popup');
    userImageButton.addEventListener('click', () =>{
        userPop.classList.toggle('hide');
    })
</script>
    <!--hero section-->
    <header class="hero-section">
        <div class="content">
            <img src="img/light-logo.png" class="logo" alt="">
            <p class="sub-heading">Biến chiến trường thành sân khấu của bạn</p>
        </div>
    </header>

    <div class="box">
                <a class="titlefilter">Bộ lọc <img src="img/filter.png"></a>
                <?php include_once('addfil.php'); ?>
            <a class="nameselect-combo">Giá</a>
            <select id="select-cost" class="select-combo">
                <option value="">chọn khoảng giá</option>
                <option value="`%s`<2000000">dưới 2 triệu</option>
                <option value="`%s`>=2000000 AND `%s`<4000000">từ 2 tới 4 triệu</option>
                <option value="`%s`>=4000000 AND `%s`<6000000">từ 4 tới 6 triệu</option>
                <option value="`%s`>=6000000">trên 6 triệu</option>
            </select>
        </div>
        <div class="box">
            <select id="select-sort" class="select select-combo">
                <option value="">Xếp theo: Nổi bật</option>
                <option value="ASC">Giá từ thấp đến cao</option>
                <option value="DESC">Giá từ cao đến thấp</option>
            </select>
        </div>
        </div>

    <!-- <script type="module">
        import {pagesToElement} from "./js/page.js";
        function filterProducts() {
            var xhr1 = new XMLHttpRequest();
            xhr1.open("GET", "lib_login_sesison(forAjax).php", true);
            xhr1.onload = function() {
                // Lấy giá trị được chọn trong select box
                var productSelect = document.getElementById('product-select_2');
                var productSelect_1 = document.getElementById('product-select_1');
                var productValue = productSelect_1.value;
                var productName = productSelect.value;
                var DpP = 5;
                // Tạo yêu cầu Ajax để lấy sản phẩm theo giá trị được chọn
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'filter.php?category_name=' + productName + '&GiaSP=' + productValue, true);
                xhr.onload = function() {
                    if (xhr.status === 200) { 
                        console.log(xhr.responseText);
                        var products = JSON.parse(xhr.responseText);
                        pagesToElement(products.length, DpP,document.querySelector(".list_page"),function myFunc(num) {
                        
                            // Xử lý kết quả trả về từ yêu cầu Ajax
                            var productContainer = document.getElementById('boxajax-containter');
                            var productHtml = '';   
                            for (let i = 0; i <DpP && (DpP*(num-1) + i)< products.length; i++) {
                                var page = DpP*(num-1) + i;
                                if(xhr1.responseText == 1){
                                    productHtml += `<div class="product-card"><div class="product-image"><a href="product.php?MaSP=` + products[page].id + `">`;
                                    productHtml += `<img src="` + products[page].HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                                    productHtml += `<a href="editProduct.php?id=` +  products[page].id + `"><button class="card-action-btn edit-btn">Sửa</button></a>`;
                                    productHtml += `<a href="manageProduct.php?del=1&id=` + products[page].id + `" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>`;
                                }
                                else
                                    productHtml += `<div class="product-card"><div class="product-image"><a href="product.php?MaSP=` + products[page].id + `"><img src="` + products[page].HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                                    var gia = parseInt(products[page].GiaSP);
                                    productHtml +=`</a></div><div class="product-info"><h2 class="product-brand">` + products[page].TenSP + `(` + products[page].MaSP + `)</h2><p class="product-short-des">` + products[page].MoTaSP + `</p><span class="price">` + gia.toLocaleString('vi-VN') + ` vnđ</span></div></div>`;
                            }
                            // products.forEach(function(product) {
                            //     // Tạo phần tử HTML để hiển thị sản phẩm
                            //     productHtml += `<div class="product-card"><div class="product-image"><a href="product.php?MaSP=` + product.MaSP + `">`;
                            //     if(xhr1.responseText == 1){
                            //         productHtml += `<img src="` + product.HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                            //         productHtml += `<a href="editProduct.php?id=` +  product.id + `"><button class="card-action-btn edit-btn">Sửa</button></a>`;
                            //         productHtml += `<a href="manageProduct.php?del=1&id=` + product.id + `" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>`;
                            //     }
                            //     else
                            //         productHtml += `<img src="` + product.HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                            //     var gia = parseInt(product.GiaSP);
                            //     productHtml +=`</a></div><div class="product-info"><h2 class="product-brand">` + product.TenSP + `(` + product.MaSP + `)</h2><p class="product-short-des">` + product.MoTaSP + `</p><span class="price">` + gia.toLocaleString('vi-VN') + ` vnđ</span></div></div>`;
                            // });
                            productContainer.innerHTML = `<section class="product"><h2 class="product-category">Sản phẩm mới <img src="img/new.png"></h2><button class="pre-btn"><img src="img/arrow.png" alt=""></button><button class="nxt-btn"><img src="img/arrow.png" alt=""></button><div class="product-container">` + productHtml + '</div></section>';
                        })
                    }
                }
                // const productDiv = document.getElementById('boxajax-containter');
                // productDiv.style.display = 'flex';
                // productDiv.classList.add("ajaxclass");
                xhr.onerror = function() {
                    console.error(xhr.statusText);
                };
                xhr.send();
            }
            xhr1.send();
        }
        window.filterProducts = filterProducts;
    </script> -->
    <!--cards-container-->
    <div id="boxajax-containter">
        <section class="product">
            <h2 class="product-category">Sản phẩm mới <img src="img/new.png"></h2>
            <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
            <div class="product-container">
                <?php
                $sql1 = "SELECT * FROM SanPham WHERE product_sell = 'hàng mới'";
                $result1 = mysqli_query($conn, $sql1);
                    if(mysqli_num_rows($result1) > 0){
                        $s = "";
                        while($row = mysqli_fetch_assoc($result1)) {
                            $s.='<div class="product-card">';
                            $s.='<div class="product-image">';
                            $s.= '<a href="product.php?MaSP=' . $row['MaSP'] . '">';
                            if(isLogged() == 1){
                                $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">mua ngay</button>', $row['HinhSP']);
                                $s .= sprintf('<a href="editProduct.php?id=%s"><button class="card-action-btn edit-btn">Sửa</button></a>', $row['id']);
                                $s.= sprintf('<a href="manageProduct.php?del=1&id=%s" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>', $row['id']);
                                //<a href="editProduct.php?id=' . $row['id'] . '">Sửa</a><a href="manageProduct.php?del=1&id=' .$row['id'] . '" onclick="return confirm("Are you sure?");">Del</a>
                            }
                            else
                                $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">mua ngay</button>', $row['HinhSP']);
                            $s .= '</a>';
                            $s.='</div>';
                            $s.='<div class="product-info">';
                            $s .= sprintf('<h2 class="product-brand">%s (%s)</h2>', $row['TenSP'], $row['MaSP']);
                            $s.= sprintf('<p class="product-short-des">%s</p>',$row['MoTaSP']);
                            $s.= sprintf('<span class="price">%s vnđ</span>',number_format($row['GiaSP'], 0, '', '.'));
                            $s.='</div>';
                            $s.='</div>';
                        }
                    }
                    echo $s;
                ?>
        </section>
                <div class="order-page"></div></section>
                
        <section class="product">
            <h2 class="product-category">Sản phẩm bán chạy  <img src="img/bestsell.png"></h2>
            <button class="pre-btn arrow"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn arrow"><img src="img/arrow.png" alt=""></button>
            <div class="product-container">
                <?php
                $sql1 = "SELECT * FROM SanPham WHERE product_sell = 'hàng bán chạy'";
                $result1 = mysqli_query($conn, $sql1);
                    if(mysqli_num_rows($result1) > 0){
                        $s = "";
                        while($row = mysqli_fetch_assoc($result1)) {
                            $s.='<div class="product-card">';
                            $s.='<div class="product-image">';
                            $s .= '<a href="product.php?MaSP=' . $row['MaSP'] . '">';
                            $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">mua ngay</button>', $row['HinhSP']);
                            $s .= '</a>';
                            $s.='</div>';
                            $s.='<div class="product-info">';
                            $s .= sprintf('<h2 class="product-brand">%s (%s)</h2>', $row['TenSP'], $row['MaSP']);
                            $s.= sprintf('<p class="product-short-des">%s</p>',$row['MoTaSP']);
                            $s.= sprintf('<span class="price">%s vnđ</span>',number_format($row['GiaSP'], 0, '', '.'));
                            $s.='</div>';
                            $s.='</div>';
                        }
                    }
                    echo $s;
                ?>
            </div>
        </section>
        <?php
        mysqli_close($conn);
        ?>
    </div>
    <ul class="list_page"></ul>
    <!--collections-->
    <h2 class="title-colection">Mục đáng chú ý</h2>
    <section class="collection-container">
        <a href="womenarmor.html" class="collection">
            <img src="img/women-collection.png" alt="">
            <p class="collection-title">women <br> armor</p>
        </a>
        <a href="menarmor.html" class="collection">
            <img src="img/men-collection.png" alt="">
            <p class="collection-title">Man <br> armor</p>
        </a>
        <a href="accessories.html" class="collection">
            <img src="img/accessories-collection.png" alt="">
            <p class="collection-title">phụ kiện</p>
        </a>
    </section>
            </div>
        </div>
    </section>

    <footer></footer>

    <script type="module"> 
    import { newFunc } from "./js/searchBar.js";
     document.querySelectorAll(".select-combo").forEach((e) => {
    e.addEventListener("change", () => {
      document.querySelectorAll(".product").forEach(function(e){
        e.innerHTML = "";})
      newFunc();
    });
})
    </script>
    <script src="js/search.js"></script>

    <script src="js/home.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>