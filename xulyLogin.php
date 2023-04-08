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

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        echo 'failure'; // Trả về giá trị "failure" nếu tên đăng nhập không đúng
    } else {
        $row = mysqli_fetch_assoc($result);
        if ($password == $row['password']) {
            echo 'success'; // Trả về giá trị "success" nếu đăng nhập thành công
        } else {
            echo 'failure'; // Trả về giá trị "failure" nếu mật khẩu không đúng
        }
    }

mysqli_close($conn);
?>