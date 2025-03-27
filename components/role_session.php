<?php 

    //Validasi role
	if ($_SESSION['role']=='spv' || $_SESSION['role']=='pp') {
		$role = $_SESSION['role'];
		$name = executescalar("select name from admin where username = '".$_SESSION['username']."'");
	} elseif ($_SESSION['role']=='Cashier') {
		$role = $_SESSION['role'];
		$name = executescalar("select checker_name from checker where checker_code = '".$_SESSION['username']."'");
	} else {
		header("Location:login.php");
	}

	// if($_SESSION['role']==''){
	// 	header("Location:index.php");
	// }

?>