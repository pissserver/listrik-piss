<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']!='admin'){
		if($_SESSION['role']!='super_admin'){
			header("Location:index.php");
		}
	}

	$update	= mysql_query("update note set note_text = '".$_POST['note']."' where note_id = '".$_GET['id']."'");
	if($update){
		echo "<script>window.location=('note.php')</script>";
		exit();
	}
	else{
		echo "<script>window.alert('Data Gagal Masuk');
		window.history.back()</script>";
		exit();
	}
?>