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

$category = $_GET['category_name'];
$queo = "SELECT * FROM category WHERE category_name='$category'";
$result1 = mysqli_query($conn, $queo);
$row1 = mysqli_fetch_assoc($result1);
$category_id = $row1['id'];
$sql = "SELECT * FROM sanpham WHERE category_id = '$category_id'";
$result = mysqli_query($conn, $sql);
// Đóng gói danh sách sản phẩm phù hợp vào một mảng và chuyển đổi sang định dạng JSON
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;
}
$json = json_encode($products);

// Trả về danh sách sản phẩm phù hợp dưới dạng JSON
echo $json; //echo có thể in hoặc giá trị trả về chỉ có thể là một chuỗi (không trả về 1 biến)
//echo trả về chuỗi JSON || echo json_encode($products);
?>