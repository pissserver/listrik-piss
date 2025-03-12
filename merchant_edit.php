<?php
	include "connection.php";
	//Validasi role
	session_start();
	if($_SESSION['role']==''){
		header("Location:index.php");
	}
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<link rel="icon" href="../images/icon.png">
		<link rel="shortcut icon" href="../images/icon.png" />
		<title>Detail Pengguna | PISS</title>

		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<!-- MetisMenu CSS -->
		<link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
		<!-- Timeline CSS -->
		<link href="css/plugins/timeline.css" rel="stylesheet">
		<!-- Custom CSS -->
		<link href="css/sb-admin-2.css" rel="stylesheet">
		<!-- Custom Fonts -->
		<link href="font-awesome-4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<script src="js/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#merchantView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
			});
		</script>
		<script>
			/* hide all elements & show preloader*/
			document.documentElement.className += 'js';

			/* display variabel */
			var alertLoadProcess = "<span class='alert alert-danger' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
		</script>
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.php">Admin PISS</a>
				</div>

				<ul class="nav navbar-top-links navbar-right">
					<li class="dropdown">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">
							<?php echo $_SESSION['user']; ?><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
						</a>
						<ul class="dropdown-menu dropdown-user">
						<li><a data-toggle="modal" data-target="#modalPassword" href="#"><i class="fa fa-lock fa-fw"></i> Ganti Password</a></li>
							<li><a href="#"><i class="fa fa-question-circle fa-fw"></i> Bantuan</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a></li>
						</ul>
					</li>
				</ul>
			
				<div class="navbar-default sidebar" role="navigation">
					<div class="sidebar-nav navbar-collapse">
						<ul class="nav" id="side-menu">
							<li><a href="dashboard.php"><i class="fa fa-bar-chart fa-fw"></i> Dashboard</a></li>
							<li><a href="tarif.php"><i class="fa fa-flash fa-fw"></i> Tarif Listrik</a></li>
							<li class="active">
								<a href="#"><i class="fa fa-users fa-fw"></i> Pengguna Listrik<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="register.php"><i class="fa fa-user-plus fa-fw"></i> Input Pengguna</a></li>
									<li><a class="active" href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pengguna</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-clipboard fa-fw"></i> Tagihan<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="periode.php"><i class="fa fa-clock-o fa-fw"></i> Periode Tagihan</a></li>
									<li><a href="invoice.php"><i class="fa fa-print fa-fw"></i> Cetak Tagihan</a></li>
									<li><a href="invoice_cancel.php"><i class="fa fa-close fa-fw"></i> Pembatalan Tagihan</a></li>
								</ul>
							</li>
							<li>
								<a href="#"><i class="fa fa-money fa-fw"></i> Pembayaran<span class="fa arrow"></span></a>
								<ul class="nav nav-second-level">
									<li><a href="pay.php"><i class="fa fa-money fa-fw"></i> Pembayaran Tagihan</a></li>
									<li><a href="pay_cancel.php"><i class="fa fa-close fa-fw"></i> Pembatalan Pembayaran</a></li>
								</ul>
							</li>
							<li><a href="note.php"><i class="fa fa-sticky-note-o fa-fw"></i> Catatan</a></li>
							<li><a href="report.php"><i class="fa fa-book fa-fw"></i> Laporan</a></li>
						</ul>
					</div>
				</div>
			</nav>

			<div id="page-wrapper">
				<br />
				<?php
					$mid 	= executeScalar("select merchant_id from electricity where electricity_id = '".$_GET['id']."'");
					$e_sts	= executeScalar("select electricity_sts from electricity where merchant_id = '".$mid."'");
					$eid 	= executeScalar("select e_cost_id from electricity where electricity_id = '".$_GET['id']."'");
					$price 	= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$eid."'");
					$ampere = executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$eid."'");
					$sql	= mysql_query("select * from merchant where merchant_id = '".$mid."'");
					while ($r = mysql_fetch_array($sql)){
					
				?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<i class="fa fa-list fa-fw"></i> Detail Data Pengguna Listrik
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-4">
								<div class="form-group">
									<label>Nama</label>
									<p><?php echo $r['merchant_name'].' / '.$r['merchant_id']; ?></p>             
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Alias</label>
									<p><?php echo $r['merchant_nick']; ?></p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Alamat (KTP)</label>
									<p><?php echo $r['address1']; ?></p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Alamat (Surat)</label>
									<p><?php echo $r['address2']; ?></p>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label>Telepon 1</label>
									<p><?php echo $r['phone1']; ?></p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Telepon 2</label>
									<p><?php echo $r['phone2']; ?></p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Jenis Jualan</label>
									<p><?php echo $r['merchant_type']; ?></p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<form action="merchant_action.php?task=update&id=<?php echo $mid;?>" class="form-horizontal" id="formMerchant1" name="formMerchant1" method="POST">
										<label>Status Langganan Listrik</label>
										<select class="form-control" name="sts" id="sts">
											<option value="<?php echo $e_sts;?>"><?php echo $e_sts;?></option>
											<option value="Aktif">Aktif</option>
											<option value="Tidak Aktif">Tidak Aktif</option>
										</select><br />
										<button type="submit" class="btn btn-outline btn-block btn-primary btn-sm">Simpan</button>
									</form>
								</div>
							</div>
							<div class="col-lg-5">
								<div class="form-group" style="margin-top:-10px;">
									<label>Ampere Yang Digunakan</label>
									<p><?php echo $ampere; ?> Ampere</p>
								</div>
								<div class="form-group" style="margin-top:-10px;">
									<label>Tarif Listrik</label>
									<p><?php echo format_rupiah($price); ?></p>
								</div>
								<div class="panel panel-primary">
									<div class="panel-heading">
										<i class="fa fa-sticky-note-o fa-fw"></i> Cetak Tagihan
									</div>
									<div class="panel-body">
										<div class="row">
											<form action="htmltopdf/merchant_bill.php?id=<?php echo $mid;?>" target="_blank" class="form-horizontal" id="formMerchant" name="formMerchant" method="POST">
											<div class="col-lg-6">
												<div class="form-group" style="padding:10px;">
													<label>Periode Tagihan</label>
													<select class="form-control" name="periode" id="periode" required>
														<option value="">- Pilih Periode Tagihan -</option>
													<?php 
														$sql 	= mysql_query("select * from e_periode ");
														while($d= mysql_fetch_array($sql)){
													?>
														<option value="<?php echo $d['periode_id'];?>"><?php echo $d['periode_name'].' '.$d['periode_id']; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-lg-6">
												<div class="form-group" style="padding:10px;margin-top:20px;">
													<button  class="btn btn-outline btn-block btn-info">Cetak Tagihan</button>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div> 
					</div>
				</div>
				<?php }?>
				<br />
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-primary">
							<div class="panel-heading">
								<i class="fa fa-clock-o fa-fw"></i> Histori Pembayaran Listrik
							</div>
							<div class="panel-body">
								<table id="historybayar" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="width:5%;text-align:center;">No</th>
											<th style="width:15%;text-align:center;">Periode</th>
											<th style="width:10%;text-align:center;">Biaya</th>
											<th style="width:12%;text-align:center;">Tgl Bayar</th>
											<th style="width:10%;text-align:center;">Kwitansi</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql 	= mysql_query("select * from e_pay where merchant_id = '".$mid."' and pay_sts = 'Lunas' order by pay_id desc");
										$no		= 1;
										$angs	= 0;
										while($r=mysql_fetch_array($sql)){
											$periode = executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
										?>
										<tr>
											<td style="text-align:right;"><?php echo $no; ?></td>
											<td style="text-align:center;"><?php echo date("d-m-Y", strtotime($periode)); ?></td>
											<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
											<td style="text-align:center;"><?php echo $r['pay_date']; ?></td>
											<td>
												<center><a href="htmltopdf/merchant_bill3.php?id=<?php echo $r[0]; ?>" target="_blank">
													<button class="btn btn-outline btn-primary btn-block btn-xs">Cetak</button>
												</a></center>
											</td>
										</tr>
										<?php $no++;} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<i class="fa fa-clock-o fa-fw"></i> Histori Outstanding Listrik
							</div>
							<div class="panel-body">
								<table id="historyoutstanding" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="width:5%;text-align:center;">No</th>
											<th style="width:15%;text-align:center;">Periode</th>
											<th style="width:10%;text-align:center;">Biaya</th>
											<th style="width:12%;text-align:center;">Status</th>
											<th style="width:10%;text-align:center;">Tagihan</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql 	= "select * from e_pay where merchant_id = '".$mid."' and pay_sts != 'Lunas' order by pay_id desc";
										$query 	= mysql_query($sql);
										$no		= 1;
										$angs	= 0;
										while($r=mysql_fetch_array($query)){
											$periode = executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
										?>
										<tr>
											<td style="text-align:right;"><?php echo $no; ?></td>
											<td style="text-align:center;"><?php echo $periode; ?></td>
											<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
											<td style="text-align:center;"><?php echo $r['pay_sts']; ?></td>
											<td>
												<center><a href="htmltopdf/merchant_bill2.php?id=<?php echo $r['pay_id']; ?>" target="_blank">
													<button class="btn btn-outline btn-primary btn-block btn-xs">Cetak</button></a>
												</center>
											</td>
										</tr>
										<?php $no++;} ?>
									</tbody>
								</table>
							</div> 
						</div>
					</div>
				
				</div>
				
			</div>
		</div>

		<!-- Modal Ganti Password -->
		<div class="modal fade" id="modalPassword" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><img src='../assets/image/Delete.png' width='25' height='25'/></button>
						<h4 id="header_password">Ganti Password</h4>
					</div>
					<div class="modal-body">
						<div id="data_password" style="margin-bottom: 0px;">
							<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
						</div>
						<input type="hidden" id="value_id" />
					</div>
					<div class="modal-footer">
					</div>
				</div>
			</div>
		</div>
		
		<script>
		$(document).ready(function(){
				// Auto Refresh Page
				$("#notifArea").html(alertLoadProcess);
				//$('#Area1').load("employee_table.php",function(){clearNotif();});
				setTimeout('$("html").removeClass("js")',1000); 
				
				//Modal Ganti Password
				$('#modalPassword').on('shown.bs.modal', function (e) {
					$("#notifArea").html(alertLoadProcess);
					$("#data_password").load("password.php",function(){clearNotif();});
				})
			});
			function clearNotif(){$("#notifArea").html("")};
		</script>
		
		<!-- jQuery -->
		<script src="js/jquery.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Metis Menu Plugin JavaScript -->
		<script src="js/plugins/metisMenu/metisMenu.min.js"></script>
		<!-- Custom Theme JavaScript -->
		<script src="js/sb-admin-2.js"></script>
	</body>
</html>