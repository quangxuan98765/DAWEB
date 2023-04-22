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
    <?php
        if(isLogged() == 1)
            echo '<li class="link-item"><a href="addProduct.html" class="link">Thêm sản phẩm</li>';
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
                <a class="nameselect-combo">thương hiệu</a>
                <select class="select-combo" id="product-select" onchange="filterProducts()">
                    <option value = "0">chọn loại</option>
                    <option value = "dell">dell</option>
                    <option value = "acer">acer</option>
                    <option value = "asus">asus</option>
                </select>
                <a class="nameselect-combo">Giá</a>
                <select class="select-combo" id="product-select_1" onchange="filterProducts()">
                    <option>chọn tầm giá</option>
                    <option value = "1">từ 5 tới 15 triệu</option>
                    <option value = "2">từ 15 tới 20 triệu</option>
                    <option value = "3">trên 20 triệu</option>
                </select>
                <a class="nameselect-combo">Khối lượng</a>
                <select class="select-combo">
                    <option>dưới 20kg</option>
                    <option>từ 2 tới 4 tỷ</option>
                    <option>từ 4 đến 6 tỷ</option>
                    <option>trên 6 tỷ</option>
                </select>
                <a class="nameselect-combo">nhu cầu</a>
                <select class="select-combo">
                    <option>Power Armor</option>
                    <option>Terminator</option>
                    <option>Dreagh</option>
                    <option>flak</option>
                </select>
                <a class="nameselect-combo">Tính năng đặc biệt</a>
                <select class="select-combo">
                    <option>Dịch chuyển</option>
                    <option>Bay</option>
                    <option>Màn chắn</option>
                </select>
        </div>

    <script>
        function filterProducts() {
            var xhr1 = new XMLHttpRequest();
            xhr1.open("GET", "lib_login_sesison(forAjax).php", true);
            xhr1.onload = function() {
                // Lấy giá trị được chọn trong select box
                var productSelect = document.getElementById('product-select');
                var productSelect_1 = document.getElementById('product-select_1');
                var productValue = productSelect_1.value;
                var productName = productSelect.value;

                // Tạo yêu cầu Ajax để lấy sản phẩm theo giá trị được chọn
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'filter.php?category_name=' + productName + '&GiaSP=' + productValue, true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Xử lý kết quả trả về từ yêu cầu Ajax
                        var products = JSON.parse(xhr.responseText);
                        var productContainer = document.getElementById('boxajax-containter');
                        var productHtml = '';
                        products.forEach(function(product) {
                            // Tạo phần tử HTML để hiển thị sản phẩm
                            productHtml += `<div class="product-card"><div class="product-image"><a href="product.php?MaSP=` + product.MaSP + `">`;
                            if(xhr1.responseText == 1){
                                productHtml += `<img src="` + product.HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                                productHtml += `<a href="editProduct.php?id=` +  product.id + `"><button class="card-action-btn edit-btn">Sửa</button></a>`;
                                productHtml += `<a href="manageProduct.php?del=1&id=` + product.id + `" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>`;
                            }
                            else
                                productHtml += `<img src="` + product.HinhSP + `" class="product-thumb"> <button class="card-btn">mua ngay</button>`;
                            var gia = parseInt(product.GiaSP);
                            productHtml +=`</a></div><div class="product-info"><h2 class="product-brand">` + product.TenSP + `(` + product.MaSP + `)</h2><p class="product-short-des">` + product.MoTaSP + `</p><span class="price">` + gia.toLocaleString('vi-VN') + ` vnđ</span></div></div>`;
                        });
                        productContainer.innerHTML = `<section class="product"><h2 class="product-category">Sản phẩm mới <img src="img/new.png"></h2><button class="pre-btn"><img src="img/arrow.png" alt=""></button><button class="nxt-btn"><img src="img/arrow.png" alt=""></button><div class="product-container">` + productHtml + '</div></section>';
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
    </script>
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
            </div>
        </section>

        <section class="product">
            <h2 class="product-category">Sản phẩm bán chạy  <img src="img/bestsell.png"></h2>
            <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
            <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
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

    <script src="js/home.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>