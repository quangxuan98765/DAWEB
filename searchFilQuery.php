<?php
    $data = json_decode($_GET["data"], true);
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
$sql = "SELECT * 
FROM `sanpham` 
INNER JOIN `category` ON `category`.`id` = `category_id` 
INNER JOIN `brands` ON `brands`.`id` = `brand_id`";
$setSort="";
if(isset($data["sort"])){
    $setSort =" ORDER BY `GiaSP` " . $data["sort"];
    unset($data["sort"]);
}
if(!empty($data)){
    $sql .= " WHERE "; 
    if(isset($data["searchValue"])){
        $sql .= "(LOWER(`TenSP`) LIKE '%".strtolower($data["searchValue"])."%' OR LOWER(`category_name`) LIKE '%".strtolower($data["searchValue"])."%' OR LOWER(`brand_name`) LIKE '%".strtolower($data["searchValue"])."%') ";
        unset($data["searchValue"]);
        if(!empty($data))
            $sql .=" AND ";
    }
    if(!empty($data)){
    $i=0; 
    foreach($data as $key => $value){ 
        
        $i++;
        if($key == "GiaSP"){
            $sql .= sprintf($value, $key,$key);
            continue;
        }
        $sql .= $key ."=" . "'".$value."'";
        if(count($data)>=2){
            $sql .= $i == count($data)? "": " AND ";
        }
    }
} 
}
if (isset($setSort))
        $sql .= $setSort;
$result = mysqli_query($conn,$sql);
$exdata = array();
while ($row = mysqli_fetch_assoc($result)) {
        $exdata[] = $row;
    }
echo json_encode($exdata);
?>