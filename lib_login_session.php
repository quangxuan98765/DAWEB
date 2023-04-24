<?php
session_start();

function isLogged() {
	//var_dump($_SESSION['current_username']);
	if(isset($_SESSION['current_username']) && $_SESSION['pass'] == true) {
		//var_dump($_SESSION['isAdmin']);
		if ($_SESSION['isAdmin'] == true)
			return 1;
        return 0;
	}
	return -1;
}
?>