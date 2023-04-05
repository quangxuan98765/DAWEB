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
$sql = "SELECT * FROM SanPham WHERE id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$tenSP = $row['TenSP'];
$motaSP = $row['MoTaSp'];
$giaSP = (double)$row['GiaSP'];
$maSP = $row['MaSP'];
$hinhSP = $row['HinhSP'];
$soluongSP = 1;

$sql1 = sprintf("INSERT INTO `cart` (`masp` ,`tensp`, `hinhsp`, `motasp`, `giasp` ,`soluong`) VALUES ('%s','%s', '%s', '%s', %d , %d);", $maSP, $tenSP,$hinhSP, $motaSP,$giaSP,$soluongSP);

mysqli_query($conn, $sql1);
?>