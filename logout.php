<?php
ob_start();
session_start();
session_unset();
session_destroy();
setcookie('user_id', null, -1, '/');
if(isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
	unset($_SESSION['user_name']);
	
	header("Location: index.php");
} else {
	header("Location: index.php");
}
?>