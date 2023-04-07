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

if(isset($_POST['login-btn'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $sql= "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 0){
        // Hiển thị thông báo lỗi tại đây
        echo "Sai tên đăng nhập hoặc mật khẩu";
    } else {
        while($row = mysqli_fetch_assoc($result)){
            if($password == $row['password']){
                header('Location:index.php');
            } else {
                // Hiển thị thông báo lỗi tại đây
                echo "Sai tên đăng nhập hoặc mật khẩu";
            }
        }
    }
}

mysqli_close($conn);
?>