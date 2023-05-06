<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "LaptrinhWeb2";
$json = file_get_contents('php://input');
$data = json_decode($json, true);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT `donhang`.`id` AS `id`, `city`,`tentaikhoan`, `date`, `trangthai`, `payment`, SUM(`GiaSP` * `soluong`) AS `cost` 
FROM `donhang` 
INNER JOIN `sl_sp_dh` ON `donhang`.`id` = `id_dh` 
INNER JOIN `sanpham` ON `id_sp` = `sanpham`.`id` 
INNER JOIN `diachi` ON `donhang`.`id_dc` = `diachi`.id AND `donhang`.`tentaikhoan` = `diachi`.`taikhoan`
GROUP BY `donhang`.`id`";
$action = $data["action"];
unset($data["action"]);
if($action == "changeStatus"){
    $sql = sprintf("UPDATE `donhang` SET `trangthai` = '%s' WHERE `id` = %s",$data["status"],$data["id"]);
    $result = mysqli_query($conn,$sql);
    unset($data);
}
if (isset($data)) {
    if($action == "searchDate"){
        $data["toDate"] = $data["toDate"]=='' ? date("Y-m-d"): $data["toDate"];
        $data["fromDate"] = $data["fromDate"]=='' ? "2000-01-01": $data["fromDate"];
        $sql .= sprintf(" HAVING `date` BETWEEN '%s' AND '%s' ORDER BY `date` ASC",$data["fromDate"],$data["toDate"]);
    }
    elseif ($action == "sortDate") 
       $sql .= sprintf(" ORDER BY `date` %s",$data["sort"]);
    elseif($action == "sortStatus"){
        if($data["status"] == "not wait")
            $sql .= " HAVING `trangthai` != 'waiting' ORDER BY `date` ASC";
        else $sql .= sprintf(" HAVING `trangthai` = '%s' ORDER BY `date` ASC",$data["status"]);
    }
    
 $result = mysqli_query($conn, $sql);
// if (!$result) { die("Query failed: " . mysqli_error($conn)); }
$exdata = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $exdata[] = $row;
  }
echo json_encode($exdata);
}
