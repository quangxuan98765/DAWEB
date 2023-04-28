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
    $row = mysqli_fetch_assoc($result);
    $masp = $row['MaSP'];
    $sl = $row['soluong'];
    $currentDateTime = date('Y-m-d H:i:s'); // lấy ngày giờ hiện tại theo định dạng Y-m-d H:i:s (năm-tháng-ngày giờ:phút:giây)

    $querry = sprintf("INSERT INTO `donhang` (`tentaikhoan`,`masp`,`soluong` ,`date`,`trangthai`) VALUES ('$taikhoan','$masp','$sl','$currentDateTime','Đang xử lý')");
    if ($conn->query($querry) === TRUE) {
        $del = sprintf("DELETE FROM cart WHERE `cart`.`taikhoan` = '%s'", $taikhoan);
        mysqli_query($conn, $del);
        header("Location: historycart.php");
        die();
      } else {
        echo "Error: " . $querry . "<br>" . $conn->error;
      }
  
      mysqli_close($conn);
}
?>