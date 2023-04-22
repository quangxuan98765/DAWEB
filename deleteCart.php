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

// Xóa sản phẩm được yêu cầu
$maSP = $_GET['masp'];
$sqp = "DELETE FROM cart WHERE masp='$maSP'";
$result = mysqli_query($conn, $sqp);

// Lấy danh sách các sản phẩm còn lại
$sq = "SELECT * FROM cart";
$result = mysqli_query($conn, $sq);

// Đóng gói các sản phẩm còn lại vào một mảng
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}

$json = json_encode($products);
echo $json;
?>