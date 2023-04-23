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

$idmsp = $_GET['MaSP'];
$sql = "SELECT * FROM sanpham WHERE MaSP = '$idmsp'";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php 
        $t = "SELECT * FROM SanPham WHERE MaSP = '$idmsp'";
        $kq = mysqli_query($conn, $t);
        $row = mysqli_fetch_assoc($kq);
        echo "<title>" . $row['TenSP'] . "</title>";
    ?>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/product.css">
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
                    echo '<a href="historycart.html"><img src="img/history.png"></a><a href="cart.php"><img src="img/cart.png"></a>';
                }
            ?>
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
    <section class="product-details">
        <div class="image-slider">
        <?php
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $largeImage = sprintf('<img id="large-image" src="%s" style="width: 620px; height: 412px;">', $row['HinhSP']);
            $smallImages = sprintf('<div class="anhsp" style="width: 630px">');
            $smallImages .= sprintf('<img class="small-image" src="%s" style="width: 200px; height: 133px;">', $row['HinhSP']);
            $smallImages .= sprintf('<img class="small-image" src="%s" style="width: 200px; height: 133px;">', $row['HinhSP']);
            $smallImages .= sprintf('<img class="small-image" src="%s" style="width: 200px; height: 133px;">', $row['HinhSP']);
            $smallImages .= sprintf('</div>');
        }
        echo $largeImage;
        echo $smallImages;
        ?>
        <!-- ----------------script------------------------------- -->
        <script>
            var smallImages = document.getElementsByClassName("small-image");
            for (var i = 0; i < smallImages.length; i++) {
                smallImages[i].addEventListener("click", function() {
                    var src = this.getAttribute("src");
                    document.getElementById("large-image").setAttribute("src", src);
                });
            }

            function check_addToCart() {
                // Hiển thị thông báo và lựa chọn xác nhận hoặc hủy
                if (confirm('Bạn cần đăng nhập để mua hàng. Nhấn OK để chuyển đến trang đăng nhập.')) {
                    // Chuyển hướng đến trang đăng nhập
                    window.location.href = 'login.html';
                }
            }

            function addToCart(productId) {
			// Tạo đối tượng XMLHttpRequest
                var xhr = new XMLHttpRequest();

                // Thiết lập hàm callback khi có phản hồi từ máy chủ
                xhr.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        // Xử lý phản hồi từ máy chủ
                        document.getElementById("cart-status").innerHTML = "Đã thêm vào giỏ hàng";
                    }
                };

                // Thiết lập yêu cầu POST với địa chỉ URL của trang xử lý yêu cầu và dữ liệu cần gửi đi
                xhr.open("POST", "addToCart.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("id=" + productId);
            }
        </script>
        <!-- ----------------script------------------------------- -->
        </div>
        <div class="details">
            <?php
            $sql1 = "SELECT * FROM SanPham WHERE MaSP = '$idmsp'";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $s = sprintf('<h2 class="product-brand">%s</h2>',$row['TenSP']);
                $s .= sprintf('<p class="product-short-des">%s</p>',$row['MoTaSP']);
                $s .= sprintf('<span class="product-price">%s vnđ</span>',number_format($row['GiaSP'], 0, '', '.'));
                $s .= '<br><i>Thông số chi tiết</i><div class="st-param"><ul><li data-info="Màn hình"><span class="icon-screen-size"></span><p>15.6 inch, 1920 x 1080 Pixels, IPS, 144 Hz, Anti-glare LED-backlit</p></li><li data-info="CPU"><span class="icon-cpu"></span><p>Intel, Core i5, 10300H</p></li><li data-info="RAM"><span class="icon-ram"></span><p>8 GB (1 thanh 8 GB), DDR4, 2933 MHz</p></li><li data-info="Ổ cứng"><span class="icon-hdd-black"></span><p>SSD 512 GB</p></li><li data-info="Đồ họa"><span class="icon-vga"></span><p>NVIDIA GeForce GTX 1650 4GB; Intel UHD Graphics</p></li></ul><a class="re-link js--open-modal2">Xem chi tiết thông số kỹ thuật</a></div>';
                if(isLogged() == 0 || isLogged() == 1) {
                    $s .= sprintf('<button class="btn cart-btn" onclick="addToCart(%s)">thêm vào giỏ hàng</button>', $row['id']);
                } else 
                    $s .= sprintf('<button class="btn cart-btn" onclick="check_addToCart()">thêm vào giỏ hàng</button>');
                $s.='<span id="cart-status"></span>';
            }
            echo $s;
            ?>
        </div>
    </section>

    <section class="detail-des">
        <h2 class="heading">mô tả</h2>
        <p class="des">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ex illo eius ipsum optio temporibus odit explicabo libero velit est ducimus laboriosam itaque rem perspiciatis laudantium reprehenderit asperiores porro doloribus hic nostrum, ipsa accusamus dolores. Maxime totam, hic possimus quos recusandae aperiam rem alias sint nulla temporibus fugit nesciunt, earum adipisci mollitia, sequi repellendus magnam reiciendis maiores! Sed odit repudiandae dolore necessitatibus consequuntur molestias veniam. Culpa eligendi, veritatis debitis voluptatum exercitationem quae perspiciatis laudantium ducimus reiciendis ipsum et soluta dolorem libero obcaecati commodi perferendis maxime dignissimos consequatur non atque rerum quas? Esse reiciendis, praesentium aspernatur minima similique exercitationem tempore sit.</p>  
    </section>
        <!--cards-container-->
        <section class="product">
        <h2 class="product-category">Sản phẩm cùng thương hiệu</h2>
        <button class="pre-btn"><img src="img/arrow.png" alt=""></button>
        <button class="nxt-btn"><img src="img/arrow.png" alt=""></button>
        <div class="product-container">
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 50%</span>
                    <img src="img/card1.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">BloodAngels Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">230.000₫</span><span class="actual-price">460.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 50%</span>
                    <img src="img/card2.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Black Dragons Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">230.000₫</span><span class="actual-price">460.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 30%</span>
                    <img src="img/card3.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Blood Ravens Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">280.000₫</span><span class="actual-price">400.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 30%</span>
                    <img src="img/card4.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Exorcists Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">266.000₫</span><span class="actual-price">380.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 25%</span>
                    <img src="img/card5.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Fire Lords Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">337.500₫</span><span class="actual-price">450.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 25%</span>
                    <img src="img/card6.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Iron Hands Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">270.000₫</span><span class="actual-price">360.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 15%</span>
                    <img src="img/card7.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Knights of the Chalice Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">306.000₫</span><span class="actual-price">360.000₫</span>
                </div>
            </div>
            <div class="product-card">
                <div class="product-image">
                    <span class="discount-tag">đang giảm 15%</span>
                    <img src="img/card8.png" class="product-thumb" alt="">
                    <button class="card-btn">thêm vào giỏ hàng</button>
                </div>
                <div class="product-info">
                    <h2 class="product-brand">Rift Stalkers Primaris</h2>
                    <p class="product-short-des">Mark X Tacticus Power Armor</p>
                    <span class="price">297.500₫</span><span class="actual-price">350.000₫</span>
                </div>
            </div>


        </div>
        </section>
    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/home.js"></script>
    <script src="js/product.js"></script>
</body>
</html>