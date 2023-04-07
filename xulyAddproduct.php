<?php
if(isset($_REQUEST['submitThemsp'])) {
	$tenSP = $_REQUEST['ten_sp'];
	$motaSP = $_REQUEST['mota_sp'];
	$giaSP = (double)$_REQUEST['gia_sp'];
	$maSP = $_REQUEST['ma_sp'];
    $loaiSP = $_REQUEST['loai_sp'];
	$hinhSP = '';
	uploadHinh($hinhSP);
	
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

	$sql = sprintf("INSERT INTO `sanpham` (`MaSP` ,`TenSP`, `HinhSP`, `MoTaSP`, `GiaSP`, `category_id`) VALUES ('%s','%s', '%s', '%s', %d , '%s');", $maSP, $tenSP,$hinhSP, $motaSP,$giaSP,$category_id);
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

function uploadHinh(&$hinhSP) {
	$target_dir = "../ProjectWeb/img/product/";
	$target_file = $target_dir . basename($_FILES["filetoup"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	
	  $check = getimagesize($_FILES["filetoup"]["tmp_name"]);
	  if($check !== false) {
		echo "File is an image - " . $check["mime"] . ".";
		$uploadOk = 1;
	  } else {
		echo "File is not an image.";
		$uploadOk = 0;
	  }
	

	// Check if file already exists
	if (file_exists($target_file)) {
	  //echo "Sorry, file already exists.";
	  $hinhSP = $target_file;
	  return 1;
	}

	// Check file size
	if ($_FILES["filetoup"]["size"] > 5000000) {
	  echo "Sorry, your file is too large.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	  if (move_uploaded_file($_FILES["filetoup"]["tmp_name"], $target_file)) {
		echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
		$hinhSP = $target_file;
	  } else {
		echo "Sorry, there was an error uploading your file.";
		$uploadOk = 0;
	  }
	}
	
	return $uploadOk;
}
?>