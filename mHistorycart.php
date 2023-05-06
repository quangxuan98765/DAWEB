<?php
require_once('lib_login_session.php');
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
$taikhoan = $_SESSION['current_username'];
$sql1 = "SELECT id FROM `donhang` WHERE tentaikhoan = '$taikhoan'";
$result1 = mysqli_query($conn,$sql1);
$id_1st_in_dh = array();
while ($row1 = mysqli_fetch_assoc($result1)) {
  $result2 = mysqli_query($conn,sprintf("SELECT id_sp FROM sl_sp_dh WHERE id_dh = %s",$row1["id"]));
  $t_assoc = mysqli_fetch_assoc($result2);
  $t = $t_assoc ? $t_assoc['id_sp'] : null;
  $id_1st_in_dh[$row1["id"]] = $t ? $t : null;
}
$sql2 = "SELECT `id_dh`, `id_sp`, `HinhSP`, `MaSP`, `TenSP`, `MoTaSP`, `soluong`, `GiaSP`,`date`,`trangthai` 
FROM `donhang` 
INNER JOIN `sl_sp_dh` ON `donhang`.`id` = `id_dh` 
INNER JOIN `sanpham` ON `id_sp` = `sanpham`.`id` ";
$result3 = mysqli_query($conn,$sql2);
$data_sp = array();
while ($row2 = mysqli_fetch_assoc($result3)) {
    $data_sp[] = $row2;
}

$exdata = array('id_1st_sp' => $id_1st_in_dh, 'data_sp'=>$data_sp);
echo json_encode($exdata);
?>