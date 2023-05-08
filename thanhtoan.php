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
  $currentDateTime = date("Y-m-d"); // lấy ngày giờ hiện tại theo định dạng Y-m-d H:i:s (năm-tháng-ngày giờ:phút:giây)
  $pay = $_GET['pay'];
  $sdt = $_GET['sdt'];
  $loc_id = $_GET['select-loc'];
  
  $selected_option = $_REQUEST['delivery'];
  if ($selected_option == "stay") {
    $query1 = sprintf("INSERT INTO `donhang` (`tentaikhoan` ,`date`,`payment`,`id_dc`,`trangthai` , `sdt`) VALUES ('$taikhoan','$currentDateTime','$pay','nhận tại cửa hàng','waiting','$sdt')");
    mysqli_query($conn,$query1);
    $newid_dh = mysqli_insert_id($conn);
  }
  else{
    $query1 = sprintf("INSERT INTO `donhang` (`tentaikhoan` ,`date`,`payment`,`id_dc`,`trangthai` , `sdt`) VALUES ('$taikhoan','$currentDateTime','$pay','$loc_id','waiting','$sdt')");
    mysqli_query($conn,$query1);
    $newid_dh = mysqli_insert_id($conn);
  }
   
  $sql = "SELECT * FROM cart,sanpham WHERE cart.masp = sanpham.MaSP and taikhoan = '$taikhoan'";
  $result = mysqli_query($conn, $sql);

    
   while ($row = mysqli_fetch_assoc($result)) {
    $idsp = $row['id'];
    $sl = $row['soluong'];
    $querry = "INSERT INTO `sl_sp_dh` (`id_dh`,`id_sp`,`soluong`) VALUES ('$newid_dh','$idsp','$sl')";
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

  $conn = mysqli_connect($servername, $username, $password, $dbname);
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  if(isset($_GET['id_dh'])) {
    
      $id_dh = $_GET['id_dh'];
      $taikhoan = $_SESSION['current_username'];
      $sql1 = "DELETE FROM sl_sp_dh WHERE id_dh = $id_dh";
      $sql2 = "DELETE FROM donhang WHERE id = $id_dh";
      mysqli_query($conn, $sql1);
      mysqli_query($conn, $sql2);
  }
}

?>