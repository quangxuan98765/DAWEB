<!DOCTYPE html>
<html lang="vi">

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

$sql = "SELECT * FROM SanPham WHERE category = 'dell'";
$result = mysqli_query($conn, $sql);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm cho MENARMOR</title>

    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/search.css">

</head>
<body>
    
    <nav class="navbar"></nav>

    <section class="search-results">
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
                <option>Bộ binh</option>
                <option>Terminator</option>
                <option>Không binh</option>
                <option>Ám sát</option>
            </select>
            <a class="nameselect-combo">Tính năng đặc biệt</a>
            <select class="select-combo">
                <option>Dịch chuyển</option>
                <option>Bay</option>
                <option>Màn chắn</option>
            </select>
        </div>
        <div class="box">
            <a class="titlefilter">Tuỳ chọn mức giá phù hợp <img src="img/pricefilter.png"></a>
            <div class="min-max-slider" data-legendnum="2">
                <label for="min">Giá tối thiểu</label>
                <input id="min" class="min" name="min" type="range" step="1" min="0" max="50000000" />
                <label for="max">Giá tối đa</label>
                <input id="max" class="max" name="max" type="range" step="1" min="0" max="50000000" />
            </div>
            <div class="btnend">
                <button class="un-selectBtn">Bỏ chọn</button>
                <button class="detailBtn">Xem kết quả</button>
            </div>
        </div>
        <div class="box">
            <input type="checkbox" checked id="date">
            <label for="date" class="checktext">Mới nhất <img src="img/new.png" class="iconimg"></label>
            <input type="checkbox" id="ship">
            <label for="ship" class="checktext">Giao nhanh</label>
            <input type="checkbox" id="selloff">
            <label for="selloff" class="checktext">Giảm giá</label>
            <input type="checkbox" id="vjp">
            <label for="vjp" class="checktext">Độc quyền</label>
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
                        $s .='<a href="product.php?id=' . $row['id'] . '">';
                        $s.= sprintf('<img src="%s" class="product-thumb"> <button class="card-btn">thêm vào giỏ hàng</button>', $row['HinhSP']);
                        $s .='</a>';
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
    <h2 class="read-more">xem thêm</h2>

    <footer></footer>

    <script src="js/nav.js"></script>
    <script src="js/footer.js"></script>
    <script src="js/search.js"></script>
</body>
</html>