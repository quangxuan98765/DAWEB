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
    <link rel="stylesheet" href="css/cart.css">
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
        <div class="upload-image-sec">
            <p class="text"><img src="img/camera.png" alt="">tải ảnh lên</p>
            <div class="upload-catalouge">
                <input type="file" class="fileupload" id="image-upload1" name="filetoup[]" accept="image/*" style="width: 90px;">
                <img id="image-preview1" src="<?= $row['HinhSP'] ?>" style="display: block;width: 100px;">
                <input type="file" class="fileupload" id="image-upload2" name="filetoup[]" accept="image/*" style="width: 90px;">
                <img id="image-preview2" src="<?= $row['more_img'] ?>" style="display: block;width: 100px;">
                <input type="file" class="fileupload" id="image-upload3" name="filetoup[]" accept="image/*" style="width: 90px;">
                <img id="image-preview3" src="<?= $row['more_img1'] ?>" style="display: block;width: 100px;">
                <input type="file" class="fileupload" id="image-upload4" name="filetoup[]" accept="image/*" style="width: 90px;">
                <img id="image-preview4" src="<?= $row['more_img2'] ?>" style="display: block;width: 100px;">
            </div>
        </div>
        <script>
            const imageUploads = document.querySelectorAll('.fileupload');
            const imagePreviews = document.querySelectorAll('img[id^="image-preview"]');
        
            for (let i = 0; i < imageUploads.length; i++) {
                imageUploads[i].addEventListener('change', function() {
                    const file = this.files[0];
                    const imagePreview = imagePreviews[i];
        
                    if (file) {
                        const reader = new FileReader();
        
                        reader.addEventListener('load', function() {
                            imagePreview.setAttribute('src', this.result);
                            imagePreview.style.display = 'block';
                        });
        
                        reader.readAsDataURL(file);
                    }
                });
            }
        </script>
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
            <input type="number" id="selling-price" name="gia_sp" placeholder="giá bán">
        </div>

        <input type="number" id="stock" min="20" placeholder="Nhập số lượng vào kho (tối thiểu 20)">

        <select class="select" name="thuong_hieu">
            <option value = "0">chọn Thương Hiệu</option>
            <option value = "DELL">dell</option>
            <option value = "ACER">acer</option>
            <option value = "ASUS">asus</option>
        </select>
        <select class="select" name="loai_sp">
            <option value = "0">Chọn loại</option>
            <option value = "laptop">Laptop</option>
            <option value = "phụ kiện">Phụ kiện</option>
        </select>

        <script>
            function validateForm() {
                var gia = document.forms["themsp"]["selling-price"].value;
                var name = document.forms["themsp"]["product-name"].value;
                var img1 = document.forms["themsp"]["image-upload1"].value;
                var img2 = document.forms["themsp"]["image-upload2"].value;
                var img3 = document.forms["themsp"]["image-upload3"].value;
                var img4 = document.forms["themsp"]["image-upload4"].value;
                if (name == "" || gia =="" || img1 == "" || img2 == "" || img3 == "" || img4 =="") {
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