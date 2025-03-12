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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<link rel="icon" href="../images/icon.png">
    <link rel="shortcut icon" href="../images/icon.png" />
    <title>Input Pengguna | PISS</title>

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
	<script language="javascript">
		/* hide all elements & show preloader*/
		document.documentElement.className += 'js';
		/* display variabel */
		var alertLoadProcess = "<span class='alert alert-info' onclick='clearNotif()'><i class='fa fa-spinner fa-spin'></i> Loading...</span>";
		
		//fungsi input hanya angka
		function isNumber(event) {
		  if (event) {
			var charCode = (event.which) ? event.which : event.keyCode;
			if (charCode != 190 && charCode > 31 && 
			   (charCode < 48 || charCode > 57) && 
			   (charCode < 96 || charCode > 105) && 
			   (charCode < 37 || charCode > 40) && 
				charCode != 110 && charCode != 8 && charCode != 46 )
			   return false;
		  }
		  return true;
		}
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
						<li>
							<a href="#"><i class="fa fa-flash fa-fw"></i> Biaya Listrik<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a href="tarif.php"><i class="fa fa-flash fa-fw"></i> Biaya Listrik</a></li>
								<li><a href="tarif2.php"><i class="fa fa-flash fa-fw"></i> Biaya Perlengkapan Listrik</a></li>
							</ul>
						</li>
						<li class="active">
                            <a href="#"><i class="fa fa-users fa-fw"></i> Pelanggan Listrik<span class="fa arrow"></span></a>
							<ul class="nav nav-second-level">
								<li><a class="active" href="register.php"><i class="fa fa-user-plus fa-fw"></i> Input Pengguna</a></li>
								<li><a href="merchant.php"><i class="fa fa-users fa-fw"></i> Data Pelanggan Listrik</a></li>
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
						<li><a href="note.php"><i class="fa fa-sticky-note-o fa-fw"></i> Catatan Untuk Pelanggan</a></li>
						<li><a href="report.php"><i class="fa fa-book fa-fw"></i> Laporan</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-3" style="padding:10px;">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <i class="fa fa-plus fa-fw"></i><strong> Tambah Pengguna Listrik PISS</strong>
                        </div>
                        <div class="panel-body">
                            <form action="register_action.php?task=insert"  id="formRegister" name = "formRegister" method="POST" class="form-horizontal">
								<div class="form-group" style="padding:10px;">
									<label>Nama Pengguna Listrik</label>
									<select class="form-control" name="mid" id="mid" autofocus="autofocus" required>
										<option value="" selected disabled>-- Pilih Pedagang --</option>
										<?php 
											$sql = mysql_query("select 		merchant_id, 
																			merchant_name, 
																			merchant_nick 
																from 		merchant 
																where 		merchant_status = 'Aktif' 
																order by 	merchant_id, 
																			merchant_nick, 
																			merchant_name");
											while($d = mysql_fetch_array($sql)){
												$lid 	= executeScalar("select lapak_id from rent where merchant_id = '".$d['merchant_id']."' AND rent_sts != 'Batal'");
												$lpk 	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
												$nick	= executeScalar("select merchant_nick from merchant where merchant_id = '".$d['merchant_id']."'");
												if($nick!=''){
													echo '<option value='.$d['merchant_id'].'>'.$d['merchant_id'].' / '.$d['merchant_nick'].' / '.$d['merchant_name'].' / '.$lpk.'</option>';
												}
												else{
													echo '<option value='.$d['merchant_id'].'>'.$d['merchant_id'].' / '.$d['merchant_name'].' / '.$lpk.'</option>';
												}
											} 
										?>
									</select>
								</div>
								<div class="form-group" style="padding:10px;">
									<label for="sel1">Lapak Listrik Dipasang :</label>
									<select class="form-control" name="lapak" id="lapak">
										<!-- Lapak akan diload menggunakan ajax, dan ditampilkan disini -->
										<option value="" selected disabled>-- Pilih Pedagang Dahulu --</option>
									</select>
								</div>
								<div class="form-group" style="padding:10px;">
									<label>Daya Yang Digunakan</label>
									<select class="form-control" name="tarif" id="tarif" required>
									<option value="" selected disabled>-- Pilih Ampere --</option>
									<?php 
										$sql 	= mysql_query("select * from e_cost order by e_cost_ampere");
										while($d= mysql_fetch_array($sql)){
									?>
										<option value="<?php echo $d['e_cost_id'];?>"><?php echo $d['e_cost_ampere']; ?> Ampere</option>
									<?php } ?>
									</select>
								</div>
								<div class="form-group" style="padding:10px;">
									<label>Petugas Lapangan</label>
									<select class="form-control" name="petugas" id="petugas" required>
									<option value="" selected disabled>-- Pilih Petugas --</option>
									<?php 
										$sql 	= mysql_query("select * from checker where checker_role = 'Kepala Teknisi' OR checker_role = 'Teknisi'");
										while($d= mysql_fetch_array($sql)){
									?>
										<option value="<?php echo $d['checker_id'];?>"><?php echo $d['checker_name']; ?></option>
									<?php } ?>
									</select>
								</div>
								<div class="form-group" style="padding:10px;">
									<center><button type="submit" class="btn btn-outline btn-block btn-primary">Simpan</button></center>
								</div>
							</form> 
                        </div>
                    </div>
                </div>
                <div class="col-lg-9" style="margin-top:-10px;">
                    <div id="Area1">
						<div class="alert alert-info" onclick="clearNotif()">
							<center><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></center>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>

	<!-- Modal nonkomoditi -->
	<div class="modal fade" id="modalPerlengkapan" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 id="header_nonkomoditi">Data Barang Non Komoditi</h4>
				</div>
				<div class="modal-body">
					<div id="data_nonkomoditi" style="margin-bottom: 0px;">
						<div class="alert alert-info" onclick="clearNotif()"><h3><i class="fa fa-spinner fa-spin"></i> Loading...</h3></div>
					</div>
					<input type="hidden" id="value_id" />
				</div>
				<div class="modal-footer">
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
			$('#Area1').load("register_table.php",function(){clearNotif();});
			setTimeout('$("html").removeClass("js")',1000); 
			
			//Modal Nonkomoditi
			$('#modalPerlengkapan').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_perlengkapan").load("modal_perlengkapan.php?",function(){clearNotif();});
			})
			//Modal Ganti Password
			$('#modalPassword').on('shown.bs.modal', function (e) {
				$("#notifArea").html(alertLoadProcess);
				$("#data_password").load("password.php",function(){clearNotif();});
			})

			$("#mid").change(function(){
				// variabel dari nilai combo box pedagang
				var merchant_id = $("#mid").val();
				// alert(merchant_id);
				// Menggunakan ajax untuk mengirim dan dan menerima data dari server
				$.ajax({
					type: "POST",
					dataType: "html",
					url: "ambil-data-lapak.php",
					data: "merchant="+merchant_id,
					success: function(data){
						// alert(data);
						$("#lapak").html(data);
					}
				});
        	});
		});
		function clearNotif(){$("#notifArea").html("");}
		
		//Memanggil modal Perlengkapan
		function perlengkapan(){
			$('#modalPerlengkapan').modal('show');
		}

    </script>
	
    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/sb-admin-2.js"></script>
</body>
</html>