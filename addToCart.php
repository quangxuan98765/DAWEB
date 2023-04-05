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

$id = $_POST['id'];
$sql = "SELECT * FROM sanpham WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$masp = $row['MaSP'];
$tenSP = $row['TenSP'];
$motaSP = $row['MoTaSp'];
$giaSP = (double)$row['GiaSP'];
$hinhSP = $row['HinhSP'];
$soluongSP = 1;

$sql1 = "SELECT * FROM cart WHERE masp = '$masp'";
$result1 = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result1) > 0){
  $sql1 = sprintf("UPDATE `cart` SET soluong = soluong + 1 WHERE masp = '$masp'");
  mysqli_query($conn, $sql1);
}else{
  $sql1 = sprintf("INSERT INTO `cart` (`masp` ,`tensp`, `hinhsp`, `motasp`, `giasp` ,`soluong`) VALUES ('%s','%s', '%s', '%s', %d , %d);", $masp, $tenSP,$hinhSP, $motaSP,$giaSP,$soluongSP);
  mysqli_query($conn, $sql1);
}
?>
