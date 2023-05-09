<?php
require_once('lib_login_session.php');
unset($_SESSION['current_username']);
unset($_SESSION['isAdmin']);
echo 'ok';
?>