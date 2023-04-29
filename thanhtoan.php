<?php
require_once('lib_login_session.php');

if(isset($_REQUEST['dathang'])) {
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

    $taikhoan = $_SESSION['current_username'];
    $sql = "SELECT * FROM cart,sanpham WHERE cart.masp = sanpham.MaSP and taikhoan = '$taikhoan'";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result)) {
    $masp = $row['MaSP'];
    $sl = $row['soluong'];
    $currentDateTime = date('Y-m-d H:i:s'); // lấy ngày giờ hiện tại theo định dạng Y-m-d H:i:s (năm-tháng-ngày giờ:phút:giây)
    $pay = $_GET['delivery'];

    $querry = sprintf("INSERT INTO `donhang` (`tentaikhoan`,`masp`,`soluong` ,`date`,`trangthai` , `payment`) VALUES ('$taikhoan','$masp','$sl','$currentDateTime','Đang xử lý' ,'$pay')");
    $kq = $conn->query($querry);
    }
    if ($kq === TRUE) {
        $del = sprintf("DELETE FROM cart WHERE `cart`.`taikhoan` = '%s'", $taikhoan);
        mysqli_query($conn, $del);
        echo $pay;
        header("Location: historycart.php");
        die();
      } else {
        echo "Error: " . $querry . "<br>" . $conn->error;
      }
  
      mysqli_close($conn);
}

if(isset($_REQUEST['huydon'])) {
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

  // Check if the id parameter is set
  if(isset($_GET['id'])) {
      $maSP = $_GET['id'];
      $taikhoan = $_SESSION['current_username'];

      $sql = "DELETE FROM donhang WHERE id = '$maSP' and tentaikhoan = '$taikhoan'";
      mysqli_query($conn, $sql);

      // Lấy danh sách các sản phẩm còn lại
      $sq = "SELECT *,donhang.id as did FROM sanpham,donhang WHERE donhang.masp = sanpham.MaSP and donhang.tentaikhoan = '$taikhoan';";
      $result = mysqli_query($conn, $sq);

      // Đóng gói các sản phẩm còn lại vào một mảng
      $products = array();
      while ($row = mysqli_fetch_assoc($result)) {
          $products[] = $row;
      }

      $json = json_encode($products);
      echo $json;
  }
}

?>