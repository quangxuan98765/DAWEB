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
$sqlSort ="";
unset($data["action"]);

if($action == "changeStatus"){
    $sql = sprintf("UPDATE `donhang` SET `trangthai` = '%s' WHERE `id` = %s",$data["status"],$data["id"]);
    $result = mysqli_query($conn,$sql);
    unset($data);
}else if ($action == "sort" && !empty($data)) {
    $sqldk = " HAVING ";
    if(isset($data["sortType"])){
      if ($data["sortType"] == "sortDate") {
       $sqlSort = sprintf(" ORDER BY `date` %s ",$data["sort"]);
       unset($data["sortType"],$data["sort"]);
       $sqldk = !empty($data)?" HAVING ":"";  
      }
    elseif($data["sortType"] == "sortStatus"){
        if($data["sort"] == "not wait")
            $sql .= $sqldk . " `trangthai` != 'waiting' ";
        else $sql .= $sqldk . sprintf(" `trangthai` = '%s' ",$data["sort"]);
        $sqldk ="";
      unset($data["sortType"],$data["sort"]);
       $sql .= !empty($data)?" AND ": "";
    }
  }

    if(isset($data["searchDate"])){
        $data["toDate"] = $data["toDate"]=='' ? date("Y-m-d"): $data["toDate"];
        $data["fromDate"] = $data["fromDate"]=='' ? "2000-01-01": $data["fromDate"];
        $sql .= $sqldk . sprintf(" `date` BETWEEN '%s' AND '%s' ",$data["fromDate"],$data["toDate"]); 
        $sqldk ="";
        unset($data["searchDate"],$data["toDate"],$data["fromDate"]);
        $sql .= !empty($data)?" AND ": "";
    }  
  if(isset($data["location"]))
    $sql .= $sqldk . sprintf(" `city` =  '%s' ",$data["location"]);
  $sql .= $sqlSort;
 $result = mysqli_query($conn, $sql);
// if (!$result) { die("Query failed: " . mysqli_error($conn)); }
$exdata = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $exdata[] = $row;
  }
echo json_encode($exdata);
}
