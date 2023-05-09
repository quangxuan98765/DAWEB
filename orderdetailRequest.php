<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LaptrinhWeb2";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$id_dh = $_GET["id_dh"];
$sql = "SELECT fullname, `donhang`.id as id, sdt,`date`,sonha,tenduong,city,trangthai,payment,GiaSP,HinhSP,TenSP,MoTaSP,soluong
FROM `donhang` 
INNER JOIN `sl_sp_dh` ON `donhang`.`id` = `id_dh` 
INNER JOIN `sanpham` ON `id_sp` = `sanpham`.`id` 
INNER JOIN `users` ON `donhang`.tentaikhoan = `users`.username
INNER JOIN `diachi` ON `donhang`.id_dc = `diachi`.id AND `donhang`.tentaikhoan = `diachi`.taikhoan
WHERE `donhang`.id = $id_dh";
$result = mysqli_query($conn,$sql);
$exdata = array();
while ($row = mysqli_fetch_assoc($result)) {
    $exdata[] = $row;
}
echo json_encode($exdata);
?>