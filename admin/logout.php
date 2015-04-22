<?php 
	session_start();
	unset($_SESSION['admin_session']); 
	header("Location: login.php");
	
	exit;	
?>