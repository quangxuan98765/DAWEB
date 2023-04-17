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
$maSP = $_GET['masp'];
$sqp = "DELETE FROM cart WHERE masp='$maSP'";
mysqli_query($conn, $sqp);
?>