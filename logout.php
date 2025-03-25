<?php
	session_start();
	session_destroy();
	unset($_SESSION['uid']);
	unset($_SESSION['name']); 
	unset($_SESSION['role']); 
	session_regenerate_id();
	header("Location: login.php");
	exit();
?>