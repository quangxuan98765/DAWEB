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

$category = $_GET['category'];
$sql = "SELECT * FROM sanpham WHERE category = $category";
$result = mysqli_query($conn, $sql);
// Đóng gói danh sách sản phẩm phù hợp vào một mảng và chuyển đổi sang định dạng JSON
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
$json = json_encode($products);

// Trả về danh sách sản phẩm phù hợp dưới dạng JSON
echo $json;

?>