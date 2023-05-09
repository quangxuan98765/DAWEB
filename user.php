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
  $result;
  $role = $_POST["role"];
  if ($role == "")
    $result = mysqli_query($conn, "SELECT `fullname`,`username`,`role`,`disabled` FROM `users`");
  else
    $result = mysqli_query($conn, sprintf("SELECT `fullname`,`username`,`role`,`disabled` FROM `users` WHERE `role`= '%s'", $role));
  $exdata = array();
  while ($row = mysqli_fetch_assoc($result)) {
    $exdata[] = $row;
  }

  echo json_encode($exdata);
