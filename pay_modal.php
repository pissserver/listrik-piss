<?php
	session_start();
	include "connection.php";
	//Validasi role
	if($_SESSION['role']==''){
		header("Location:index.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body>
	<br /><br /><br />
		<div class="row" style="margin-right:10px;margin-left:10px;margin-top:10px;margin-bottom:10px;">
			<div class="col-md-8 col-md-offset-2">
				<form action="pay_action.php?task=insert&id=<?php echo $_GET['id']; ?>"  id="form_pay" name="form_pay" method="POST" class="form-horizontal">
					<label>Input Tanggal Bayar</label>
					<input id="pay_date" name="pay_date" type="date" class="form-control form-xs" required />
					<br />
					<button type="submit" class="btn btn-outline btn-primary btn-block btn-xs">Bayar</button>
				</form>
			</div>
		</div>
	<br /><br /><br />
</body>
</html>
