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

$id = $_GET['id'];
$sql = "SELECT * FROM sanpham WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (!$result) { die("Query failed: " . mysqli_error($conn)); }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link rel="stylesheet" href="css/sigup.css">
    <link rel="stylesheet" href="css/addProduct.css">
</head>
<body>
    <img src="img/loader.gif" class="loader" alt="">

    <div class="alert-box">
        <img src="img/error.png" class="alert-img" alt="">
        <p class="alert-msg">Lỗi</p>
    </div>

    <img src="img/dark-logo.png" class="logo" alt="">
    <form name="themsp" method="post" action="manageProduct.php" enctype="multipart/form-data">
        <div class="form">
            <input type="hidden" name="id" value=<?=$row['id']?>/>
            <input type="text" id="product-name" name="ten_sp" placeholder="Tên sản phẩm" value="<?= $row['TenSP'] ?>">
            <input type="text" name="ma_sp" id="short-des" placeholder="Mã sản phẩm" value="<?= $row['MaSP'] ?>">
            <textarea id="des" name="mota_sp" placeholder="Mô tả chi tiết về sản phẩm"><?php echo $row['MoTaSP']; ?></textarea>
        </div>

        <!-- product image -->
        <div class="product-info">
            <div class="product-image"><p class="text">ảnh sản phẩm</p></div>
            <!-- upload inputs -->
            <div class="upload-image-sec">
                <p class="text"><img src="img/camera.png" alt="">tải ảnh lên</p>
                <div class="upload-catalouge">
                    <input type="file" class="fileupload" id="first-file-upload-btn" name="filetoup" hidden>
                    <label for="first-file-upload-btn" class="upload-image" ></label>
                </div>
            </div>
            <!-- <div class="select-sizes">
                <p class="text">size hiện có</p>
                <div class="sizes">
                    <input type="checkbox" class="size-checkbox" id="xs" value="xs">
                    <input type="checkbox" class="size-checkbox" id="x" value="x">
                    <input type="checkbox" class="size-checkbox" id="m" value="m">
                    <input type="checkbox" class="size-checkbox" id="l" value="l">
                    <input type="checkbox" class="size-checkbox" id="xl" value="xl">
                    <input type="checkbox" class="size-checkbox" id="xxl" value="xxl">
                    <input type="checkbox" class="size-checkbox" id="xxxl" value="xxxl">
                </div>
            </div> -->
        </div>
        <div class="product-price">
            <input type="number" id="selling-price" name="gia_sp" placeholder="giá bán" value="<?= $row['GiaSP'] ?>">
        </div>

        <input type="number" id="stock" min="20" placeholder="Nhập số lượng vào kho (tối thiểu 20)">

        <?php
            $loaiSP = $row['category_id'];
            $queo = "SELECT * FROM category WHERE id='$loaiSP'";
            $result1 = mysqli_query($conn, $queo);
            $row1 = mysqli_fetch_assoc($result1);
        ?>
        <textarea id="tags" name="loai_sp" placeholder="Nhập phân loại sản phẩm tại đây, ví dụ - Men Armor, Power Armor, Primaris Armor,... (bạn phải nhập men hoặc women trước để bắt đầu)"><?php echo $row1['category_name']; ?></textarea>

        <input type="checkbox" class="checkbox" id="tac" checked>
        <label for="tac">Tôi đã kiểm tra kĩ thông tin</label>

        <script>
            function validateForm() {
                var gia = document.forms["themsp"]["selling-price"].value;
                var name = document.forms["themsp"]["product-name"].value;
                var img = document.forms["themsp"]["first-file-upload-btn"].value;
                if (name == "" || img == "" || gia =="") {
                    alert("Bạn cần nhập tên,giá sản phẩm và tải ảnh sản phẩm lên trước khi thêm sản phẩm.");
                    return false;
                }
            }
        </script>

        <div class="buttons">
            <button class="btn" id="add-btn" name="submitSuasp" onclick="return validateForm()">lưu chỉnh sửa</button>
        </div>
</form>
    <script src="js/addProduct.js"></script>
    
</body>
</html>