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
$gia = $_GET['GiaSP'];
if($category == 0){
  if($gia == 1)
    $sql = "SELECT * FROM sanpham WHERE GiaSP >= 5000000 and GiaSP <= 15000000";
  else if($gia == 2)
    $sql = "SELECT * FROM sanpham WHERE GiaSP >= 15000000 and GiaSP <= 20000000";
  else if($gia == 3)
    $sql = "SELECT * FROM sanpham WHERE GiaSP >= 20000000";
} else{
  $queo = "SELECT * FROM category WHERE category_name='$category'";
  
  $result1 = mysqli_query($conn, $queo);
  $row1 = mysqli_fetch_assoc($result1);
  $category_id = $row1['id'];
  if($gia == 1)
    $sql = "SELECT * FROM sanpham". (isset($category_id)? " WHERE category_id = $category_id and":" ") ." GiaSP >= 5000000 and GiaSP <= 15000000";
  else if($gia == 2)
    $sql = "SELECT * FROM sanpham". (isset($category_id)? " WHERE category_id = $category_id and":" ") ." GiaSP >= 15000000 and GiaSP <= 20000000";
  else if($gia == 3)
    $sql = "SELECT * FROM sanpham". (isset($category_id)? " WHERE category_id = $category_id and":" ") ." GiaSP >= 20000000";
  else
    $sql = "SELECT * FROM sanpham". (isset($category_id)? " WHERE category_id = $category_id ":" ") ;
}
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