<?php
	session_start();
	include "connection.php";

	function antiInjection($data){
		$filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
		return $filter_sql;
	}

	$login	= mysql_query("select username, role from admin 
			where username 	= '".antiinjection($_POST["user"])."' and 
				password 	= '".antiinjection($_POST["pass"])."' and
				listrik 	= 'Yes'");
	$ketemu	= mysql_num_rows($login);
	$r		= mysql_fetch_array($login);
	
	if($ketemu==1){
		$_SESSION['user'] 	= $r['username'];
		$_SESSION['role'] 	= $r['role'];
		echo "<script>window.location=('dashboard.php')</script>";
		exit();
	}
	else{
		$login2	= mysql_query("select checker_name, checker_role from checker
			where checker_code 	= '".antiinjection($_POST["user"])."' and 
				checker_pass 	= '".antiinjection($_POST["pass"])."' and
				checker_role 	= 'Cashier' and
				checker_sts		= 'Aktif'");
		$ada	= mysql_num_rows($login2);
		$r		= mysql_fetch_array($login2);
		if($ada==1){
			$_SESSION['user'] 	= $r['checker_name'];
			$_SESSION['role'] 	= $r['checker_role'];
			echo "<script>window.location=('dashboard.php')</script>";
			exit();
		}
		echo "<script>window.alert('Anda Tidak Memiliki Hak Untuk Masuk!');
			window.history.back()</script>";
		exit();
	}
?>