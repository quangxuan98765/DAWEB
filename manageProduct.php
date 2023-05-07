<?php
if(isset($_REQUEST['submitThemsp'])) {
	$tenSP = $_REQUEST['ten_sp'];
	$motaSP = $_REQUEST['mota_sp'];
	$giaSP = (double)$_REQUEST['gia_sp'];
	$maSP = $_REQUEST['ma_sp'];
    $loaiSP = $_REQUEST['loai_sp'];
	$brands = $_REQUEST['thuong_hieu'];
	$hinhSPs = array();
	uploadHinh($hinhSPs);
	
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

	$queo = "SELECT * FROM category WHERE category_name='$loaiSP'";
	$result1 = mysqli_query($conn, $queo);
	$row = mysqli_fetch_assoc($result1);
	$category_id = $row['id'];

	$queo1 = "SELECT * FROM brands WHERE brand_name='$brands'";
	$result2 = mysqli_query($conn, $queo1);
	$row1 = mysqli_fetch_assoc($result2);
	$b = $row1['id'];

	$sql = sprintf("INSERT INTO `sanpham` (`MaSP`, `TenSP`, `HinhSP`, `more_img`, `more_img1`, `more_img2`, `MoTaSP`, `GiaSP`, `category_id`, `brand_id`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', '%s');", $maSP, $tenSP, $hinhSPs[0], $hinhSPs[1], $hinhSPs[2], $hinhSPs[3], $motaSP, $giaSP, $category_id, $b);
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
	  echo "<hr/>New record created successfully";
	  //header("Location: index.php");
	  die();
	} else {
	  echo "Error: " . $sql . "<br>" . $conn->error;
	}

	mysqli_close($conn);
}

if(isset($_REQUEST['submitSuasp'])) {
	$tenSP = $_REQUEST['ten_sp'];
	$motaSP = $_REQUEST['mota_sp'];
	$giaSP = (double)$_REQUEST['gia_sp'];
	$maSP = $_REQUEST['ma_sp'];
    $loaiSP = $_REQUEST['loai_sp'];
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
	$queo = "SELECT * FROM category WHERE category_name='$loaiSP'";
	$result1 = mysqli_query($conn, $queo);
	$row = mysqli_fetch_assoc($result1);
	$category_id = $row['id'];

	$queo1 = "SELECT * FROM brands WHERE brand_name='$brands'";
	$result2 = mysqli_query($conn, $queo1);
	$row1 = mysqli_fetch_assoc($result2);
	$b = $row1['id'];

	if($_FILES['filetoup']['name']=='') {
		//No file selected
		$sql = sprintf("UPDATE `sanpham` SET `MaSP` = '%s', `TenSP` = '%s', `MoTaSP` = '%s', `GiaSP` = '%f', `category_id` = '%s', `brand_id` = '%s' WHERE `sanpham`.`id` = %d;", $maSP, $tenSP, $motaSP,$giaSP,$category_id, $b, $id);
	}
	else {
		$hinhSPs = array();
		uploadHinh($hinhSPs);
		$sql = sprintf("UPDATE `sanpham` SET `MaSP` = '%s', `TenSP` = '%s', `HinhSP` = '%s', `more_img` = '%s', `more_img1` = '%s', `more_img2` = '%s', `MoTaSP` = '%s', `GiaSP` = '%f', `category_id` = '%s' WHERE `sanpham`.`id` = %d;", $maSP, $tenSP, $hinhSPs[0], $hinhSPs[1], $hinhSPs[2], $hinhSPs[3], $motaSP, $giaSP, $category_id, $b, $id);
	}	
	
	if ($conn->query($sql) === TRUE) {
		echo "The record editted successfully";
		//header("Location:" . 'products.php');
		exit();
	} else {
	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
}

if(isset($_REQUEST['del'])) {
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

    $sql = sprintf("DELETE FROM sanpham WHERE `sanpham`.`id` = %d", $id);

    if ($conn->query($sql) === TRUE) {
        echo "The record deleted successfully";
        //header("Location:" . 'products.php');
        exit();
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

function uploadHinh(&$hinhSP) {
	$target_dir = "../ProjectWeb/img/product/";
	
	$uploadOk = 1;
	$imageFileTypes = [];
	$uploadedFiles = [];
	
	// Check if files are actual images or fake images
	foreach ($_FILES["filetoup"]["name"] as $key => $fileName) {
		$target_file = $target_dir . basename($fileName);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$imageFileTypes[] = $imageFileType;

		$check = getimagesize($_FILES["filetoup"]["tmp_name"][$key]);
		if($check !== false) {
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
			break;
		}

		// Check if file already exists
		if (file_exists($target_file)) {
			$uploadedFiles[] = $target_file;
			continue;
		}

		// Check file size
		if ($_FILES["filetoup"]["size"][$key] > 5000000) {
			$uploadOk = 0;
			break;
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			$uploadOk = 0;
			break;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			break;
		} else {
			if (move_uploaded_file($_FILES["filetoup"]["tmp_name"][$key], $target_file)) {
				$uploadedFiles[] = $target_file;
			} else {
				$uploadOk = 0;
				break;
			}
		}
	}

	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	} else {
		$hinhSP = $uploadedFiles;
	}

	return $uploadOk;
}

?>