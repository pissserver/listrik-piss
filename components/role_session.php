<?php 

    //Validasi role
	if ($_SESSION['role']=='spv' || $_SESSION['role']=='pp') {
		$name = executescalar("select name from admin where username = '".$_SESSION['user']."'");
	} elseif ($_SESSION['role']=='Cashier') {
		$name = executescalar("select checker_name from checker where checker_code = '".$_SESSION['user']."'");
	} else {
		header("Location:index.php");
	}

	// if($_SESSION['role']==''){
	// 	header("Location:index.php");
	// }

?>