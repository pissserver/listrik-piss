<?php
	session_start();
	include "connection.php";
	
	$task	= $_GET['task'];
	//$id	= $_POST['id'];
	
	//Input Pembayaran
	if ($task=='insert'){
		$id		= $_GET['id'];
		$insert = mysql_query("update e_pay set `pay_date`	= '".$_POST['pay_date']."', 
												`pay_sts`	= 'Lunas'
											where pay_id 	= '".$id."'");
		if($insert){
			echo "<script>window.alert('Pembayaran Berhasil');
			window.location=('pay.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Gagal Masuk');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Pembatalan Pembayaran
	if ($task=='batal'){
		$id		= $_GET['id'];
		$update = mysql_query("update e_pay set `pay_date` 	= null,
												`pay_sts` 	= 'Belum Lunas' 
											where pay_id 	= '".$id."'");
		if($update){
			echo "<script>window.alert('Pembatalan Pembayaran Berhasil');
			window.location=('pay_cancel.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Gagal Masuk');
			window.history.back()</script>";
			exit();
		}
	}
	
	//Pembatalan Pembayaran
	if ($task=='absen'){
		$id		= $_GET['id'];
		$insert = mysql_query("update e_pay set `pay_date` 	= null, 
											`cancel_date` 	= '".$date_now."',
												`pay_sts` 	= 'Batal' 
											where pay_id 	= '".$id."'");
		if($insert){
			echo "<script>window.alert('Pembatalan Pembayaran Berhasil');
			window.location=('invoice_cancel.php')</script>";
			exit();
		}
		else{
			echo "<script>window.alert('Data Gagal Masuk');
			window.history.back()</script>";
			exit();
		}
	}
?>