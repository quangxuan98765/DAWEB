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

$sql = "SELECT * FROM SanPham";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARMOR-SHOP</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/searchIndex.css">
</head>
<body>
    <nav class="navbar"></nav>

    <!--hero section-->
    <header class="hero-section">
        <div class="content">
            <img src="img/light-logo.png" class="logo" alt="">
            <p class="sub-heading">Biến chiến trường thành sân khấu của bạn</p>
        </div>
    </header>

    <!--cards-container-->
    <section class="product">
    <div class="box">
            <a class="titlefilter">Bộ lọc <img src="img/filter.png"></a>
            <a class="nameselect-combo">thương hiệu</a>
            <select class="select-combo">
                <option>Mechanicus</option>
                <option>Orn</option>
                <option>Vulkan</option>
                <option>Emperor</option>
            </select>
            <a class="nameselect-combo">Giá</a>
            <select class="select-combo">
                <option>dưới 2 triệu</option>
                <option>từ 2 tới 4 triệu</option>
                <option>từ 4 tới 6 triệu</option>
                <option>trên 6 triệu</option>
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
                        $s .= '<a href="product.php?id=' . $row['id'] . '">';
                        $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">thêm vào giỏ hàng</button>', $row['HinhSP']);
                        $s .= '</a>';
                        $s.='</div>';
                        $s.='<div class="product-info">';
                        $s .= sprintf('<h2 class="product-brand">%s (%s)</h2>', $row['TenSP'], $row['MaSP']);
                        $s.= sprintf('<p class="product-short-des">%s</p>',$row['MoTaSP']);
                        $s.= sprintf('<span class="price">%s vnđ</span>',number_format($row['GiaSP'], 0, '', ','));
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
                        $s .= '<a href="product.php?id=' . $row['id'] . '">';
                        $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">thêm vào giỏ hàng</button>', $row['HinhSP']);
                        $s .= '</a>';
                        $s.='</div>';
                        $s.='<div class="product-info">';
                        $s .= sprintf('<h2 class="product-brand">%s (%s)</h2>', $row['TenSP'], $row['MaSP']);
                        $s.= sprintf('<p class="product-short-des">%s</p>',$row['MoTaSP']);
                        $s.= sprintf('<span class="price">%s vnđ</span>',number_format($row['GiaSP'], 0, '', ','));
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

    <script src="js/nav.js"></script>
    <script src="js/home.js"></script>
    <script src="js/footer.js"></script>
</body>
</html>