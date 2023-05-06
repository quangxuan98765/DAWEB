<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptrinhweb2";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
$text = '<a class="nameselect-combo">Thương hiệu</a><select id="select-brand" class="select-combo"><option value ="">Chọn thương hiệu</option>'; 
$result = mysqli_query($conn, "SELECT * FROM brands");
$brand = array();
while ($row = mysqli_fetch_assoc($result)) {
        $brand[] = $row;
    }
foreach($brand as $s){
    $text .= '<option value ="'.$s["id"] . '">' . $s["brand_name"] . '</option>'; 
}
$text .='</select>'.'<a class="nameselect-combo">Loại</a><select id="select-category" class="select-combo"><option value ="">Chọn loại</option>';
$result1 = mysqli_query($conn, "SELECT * FROM category");
$category = array();
while ($row = mysqli_fetch_assoc($result1)) {
    $category[] = $row;
}

foreach($category as $s){
    $text .= '<option value ='. $s["id"] . '>' . $s["category_name"] . '</option>'; 
}

echo( $text . '</select>');
