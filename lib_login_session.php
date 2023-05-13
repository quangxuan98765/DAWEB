<?php
session_start();

function isLogged() {
	//var_dump($_SESSION['current_username']);
	if(isset($_SESSION['current_username']) && $_SESSION['pass'] == true) {
		checkDisabledAccount();
	if(isset($_SESSION['current_username']) && $_SESSION['pass'] == true) {
		//var_dump($_SESSION['isAdmin']);
		
		if ($_SESSION['isAdmin'] == true)
			return 1;
        return 0;
	}
	return -1;
}
return -1;
};
function checkDisabledAccount(){
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
	
	$username = $_SESSION['current_username'];
	$sql = "SELECT `disabled` FROM `users` WHERE `username` = '$username'";
	$result = mysqli_query($conn, $sql);
	
	if($result == true ){
		$row = mysqli_fetch_assoc($result);
		if($row["disabled"] == 1){
			unset($_SESSION['current_username']);
			unset($_SESSION['isAdmin']);
			?>
				<script type="module">
					import alert from "./js/alert.js";
					alert("Tài khoản đã bị khóa","&#215;", "red",()=>{});
					setTimeout(function() {window.location.href = 'login.html';
 					 	 // Chuyển hướng đến trang mới sau 3 giây
					}, 2000)	
					
				</script>
			<?php
			
		}
	}
};
?>

