<?php
require_once('lib_login_session.php');
if(isset($_REQUEST['submit'])) {
	$city = $_REQUEST['city'];
	$road = $_REQUEST['duong'];
    $house = $_REQUEST['nha'];
    $tentk = $_SESSION['current_username'];
	
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

	$queo = "SELECT * FROM diachi WHERE taikhoan='$tentk'";
	$result1 = mysqli_query($conn, $queo);
	$row = mysqli_fetch_assoc($result1);

	$sql = sprintf("INSERT INTO `diachi` (`taikhoan` , `city`, `tenduong`, `sonha`) VALUES ('$tentk', '%s', '%s', '%s');",$city, $road,$house);
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
	  header("Location: cart.php");
	  die();
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	mysqli_close($conn);
}

if(isset($_REQUEST['submitEdit'])) {
	$city = $_REQUEST['city'];
	$road = $_REQUEST['duong'];
    $house = $_REQUEST['nha'];
    $tentk = $_SESSION['current_username'];
    $id = $_REQUEST['id'];
	
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "laptrinhweb2";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}
	$queo = "SELECT * FROM diachi WHERE taikhoan='$tentk'";
	$result1 = mysqli_query($conn, $queo);
	$row = mysqli_fetch_assoc($result1);
	$sql = sprintf("UPDATE `diachi` SET `city` = '%s', `tenduong` = '%s', `sonha` = '%s' WHERE `diachi`.`id` = %d;", $city,$road,$house, $id);
	
	if ($conn->query($sql) === TRUE) {
		header("Location:" . 'cart.php');
		exit();
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

if(isset($_REQUEST['submitDel'])) {
    $id = $_REQUEST['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "laptrinhweb2";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = sprintf("DELETE FROM diachi WHERE `diachi`.`id` = %d", $id);

    if ($conn->query($sql) === TRUE) {
        header("Location:" . 'cart.php');
        exit();
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>