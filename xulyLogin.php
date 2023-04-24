<?php
require_once('lib_login_session.php');
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

$username = $_POST['username'];
$password = $_POST['password'];
$sql = "SELECT * FROM users WHERE username = '$username'";
$sql1 = "SELECT * FROM user_roles WHERE user_name = '$username'";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);

if (mysqli_num_rows($result) == 0) {
    echo 'failure'; // Trả về giá trị "failure" nếu tên đăng nhập không đúng
} else {
    $_SESSION['current_username'] = $username;
    $row = mysqli_fetch_assoc($result);
    $row1 = mysqli_fetch_assoc($result1);
    if ($password == $row['password']) {
        $_SESSION['pass'] = true;
        if($row1['role'] == 'admin'){
            $_SESSION['isAdmin'] = true;
            echo 'success';
        }
        else{
            $_SESSION['isAdmin'] = false;
            echo 'success'; // Trả về giá trị "success" nếu đăng nhập thành công
        }
    } else {
        $_SESSION['pass'] = false;
        $_SESSION['isAdmin'] = false;
        echo 'failure'; // Trả về giá trị "failure" nếu mật khẩu không đúng
    }
}

mysqli_close($conn);
?>