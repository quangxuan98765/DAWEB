<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "laptrinhweb2";
$json = file_get_contents('php://input');
$data = json_decode($json, true);
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$action = $data["action"];
$username = $data["username"];
unset($data["action"]);
unset($data["username"]);
if (isset($data)) {
    if ($action == "edit") {
        $result = true;
        foreach ($data as $key => $value) {
            $sql = sprintf("UPDATE `users` SET `%s` = '%s' WHERE `username` = '%s'", $key, $value, $username);
            $result = $result && mysqli_query($conn, $sql);
        }
        if (!$result)
            echo "Error: " + mysqli_error($conn);
        else echo "Updated";
    }
     else if ($action = "delete") {
        mysqli_query($conn, sprintf("DELETE FROM `donhang` WHERE `tentaikhoan` = '%s'", $username));
        mysqli_query($conn, sprintf("DELETE FROM `cart` WHERE `taikhoan` = '%s'", $username));
        mysqli_query($conn, sprintf("DELETE FROM `diachi` WHERE `taikhoan` = '%s'", $username));
        $result = mysqli_query($conn, sprintf("DELETE FROM `users` WHERE `username` = '%s'", $username));
        if (!$result)
            echo "Error: " + mysqli_error($conn);
        else echo "Deleted";
    }
}
