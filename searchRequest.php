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
$data = json_decode($_GET["data"]);
if(!empty($data)){
    $sql = "SELECT * 
    FROM `sanpham` 
    INNER JOIN `category` ON `category`.`id` = `id_category` 
    INNER JOIN `brands` ON `brands`.id = `id_brand`
    WHERE "; 
    $searchSql = "LOWER(%s) LIKE '%%s%'";
    $i=0;
    foreach($data as $key => $value){ 
        $sql .= sprintf($searchSql,$key,strtolower($value));
        if(count($data)>=2){
            $sql .= $i == count($data)? "": " AND ";
        }
    }

$result = mysqli_query($conn,$sql);
$exdata = array();
while ($row = mysqli_fetch_assoc($result)) {
    $exdata[] = $row;
}
echo json_encode($exdata);

}


?>