<!DOCTYPE html>
<html lang="vi">

<?php
require_once('lib_login_session.php');
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptrinhweb2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM SanPham";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">
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
</ul>
<script>
    const userImageButton = document.getElementById("user-img");
    const userPop = document.querySelector('.login-logout-popup');
    userImageButton.addEventListener('click', () =>{
        userPop.classList.toggle('hide');
    })
</script>
    <section class="search-results">
    <div class="box">
                <a class="titlefilter">Bộ lọc <img src="img/filter.png"></a>
                <a class="nameselect-combo">thương hiệu</a>
                <select class="select-combo" id="product-select" onchange="window.filterProducts()">
                    <option value = "0">chọn loại</option>
                    <option value = "DELL">dell</option>
                    <option value = "ACER">acer</option>
                    <option value = "ASUS">asus</option>
                </select>
                <a class="nameselect-combo">Giá</a>
                <select class="select-combo" id="product-select_1" onchange="window.filterProducts()">
                    <option>chọn tầm giá</option>
                    <option value = "1">từ 5 tới 15 triệu</option>
                    <option value = "2">từ 15 tới 20 triệu</option>
                    <option value = "3">trên 20 triệu</option>
                </select>
                <a class="nameselect-combo">Loại</a>
                <select class="select-combo" id="product-select_2" onchange="window.filterProducts()">
                    <option value = "0">Chọn loại</option>
                    <option value = "laptop">Laptop</option>
                    <option value = "phụ kiện">Phụ kiện</option>
                </select>
        </div>
        <div class="box">
            <select class="select">
                <option>Xếp theo: Nổi bật</option>
                <option>% giảm</option>
                <option>Giá từ thấp đến cao</option>
                <option>Giá từ cao đến thấp</option>
            </select>
        </div>
        <div class="product-container">
            <?php
                if(mysqli_num_rows($result) > 0){
                    $s = "";
                    while($row = mysqli_fetch_assoc($result)) {
                        $s.='<div class="product-card">';
                        $s.='<div class="product-image">';
                        $s.='<a href="product.php?MaSP=' . $row['MaSP'] . '">';
                        if(isLogged() == 1){
                            $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">mua ngay</button>', $row['HinhSP']);
                            $s .= sprintf('<a href="editProduct.php?id=%s"><button class="card-action-btn edit-btn">Sửa</button></a>', $row['id']);
                            $s.= sprintf('<a href="manageProduct.php?del=1&id=%s" onclick="return confirm(\'Are you sure?\');"><button class="card-action-btn delete-popup-btn">Xóa</button></a>', $row['id']);
                            //<a href="editProduct.php?id=' . $row['id'] . '">Sửa</a><a href="manageProduct.php?del=1&id=' .$row['id'] . '" onclick="return confirm("Are you sure?");">Del</a>
                        }
                        else
                            $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">mua ngay</button>', $row['HinhSP']);
                        $s.='</a>';
                        $s.='</div>';
                        $s.='<div class="product-info">';
                        $s.= sprintf('<h2 class="product-brand">%s (%s)</h2>', $row['TenSP'], $row['MaSP']);
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
    <h2 class="read-more">xem thêm</h2>

    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search.js"></script>
</body>
</html>