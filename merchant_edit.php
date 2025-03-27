<?php
	session_start();
	include "connection.php";
	include "components/role_session.php";
	
	function headScript(){
		$headScript=file_get_contents("headScript.html");
		return $headScript;
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
        <link rel="icon" href="img/logo.png">
        <link rel="shortcut icon" href="img/logo.png" />
		<title>Detail Pengguna | PISS</title>

		<?php echo headScript(); ?>

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
		<?php include "components/sidebar.php"; ?>

			<div id="page-wrapper">
				<br /><br><br><br>
				<?php
					$id 	= executeScalar("select electricity_id from electricity where electricity_id = '".$_GET['id']."'");
					$mid 	= executeScalar("select merchant_id from electricity where merchant_id = '".$_GET['kode']."'");
					$e_sts	= executeScalar("select electricity_sts from electricity where merchant_id = '".$mid."'");
					$eid 	= executeScalar("select e_cost_id from electricity where electricity_id = '".$_GET['id']."'");
					$price 	= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$eid."'");
					$ampere = executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$eid."'");
					$sql	= mysql_query("select * from merchant where merchant_id = '".$mid."'");
					while ($r = mysql_fetch_array($sql)){
					
				?>
				<div class="panel panel-primary">
					<div class="panel-heading">
						<i class="fa fa-user fa-fw"></i> Detail Data Pengguna Listrik
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group" class="margin-left: 20px;">
									<label>Kode</label>
									<input class="form-control" value="<?php echo $r['merchant_id']; ?>" disabled></input>             
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Nama</label>
									<input class="form-control" value="<?php echo $r['merchant_name'].' / '.$r['merchant_id']; ?>" disabled></input>             
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label>Telepon 1</label>
									<input class="form-control" value="<?php echo $r['phone1']; ?>" disabled></input>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group" style="margin-top:0px;">
									<label>Ampere Yang Digunakan</label>
									<input class="form-control" value="<?php echo $ampere; ?> Ampere" disabled></input>
								</div>
							</div>
						</div> 
						
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group" style="margin-top:0px; margin-bottom: 20px;">
									<label>Alias</label>
									<input class="form-control" value="<?php echo $r['merchant_nick']; ?>" disabled></input>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group" style="margin-top:0px;">
									<label>Telepon 2</label>
									<input class="form-control" value="<?php echo $r['phone2']; ?>" disabled></input>
								</div>
							</div>

							<div class="col-lg-3">
								<div class="form-group" style="margin-top:0px; margin-bottom: 25px;">
									<label>Tarif Listrik</label>
									<input class="form-control" value="<?php echo format_rupiah($price); ?>" disabled></input>
								</div>
								<!-- <div class="panel panel-primary">
									<div class="panel-heading">
										<i class="fa fa-print fa-fw"></i> Cetak Tagihan
									</div>
									<div class="panel-body">
										<div class="row">
											<form action="htmltopdf/merchant_bill.php?id=<?php echo $mid;?>" target="_blank" class="form-horizontal" id="formMerchant" name="formMerchant" method="POST">
											<div class="col-lg-12">
												<div class="form-group" style="padding:0 10px; margin-top:-5px;">
													<label>Periode Tagihan</label>
													<select class="form-control" name="periode" id="periode" required>
														<option value="">- Pilih Periode Tagihan -</option>
													<?php 
														$sql 	= mysql_query("select * from e_periode ");
														while($d= mysql_fetch_array($sql)){
													?>
														<option value="<?php echo $d['periode_id'];?>"><?php echo $d['periode_name']; ?></option>
													<?php } ?>
													</select>
												</div>
											</div>
											<div class="col-lg-12">
												<div class="form-group" style="padding:0 10px;margin-top:0px; margin-bottom: -5px;">
													<button  class="btn btn-block btn-primary"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak Tagihan</button>
												</div>
											</div>
											</form>
										</div>
									</div>
								</div> -->
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label>Alamat (KTP)</label>
									<textarea class="form-control" disabled><?php echo $r['address1']; ?></textarea>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group" style="margin-top:-10px;">
									<label>Jenis Jualan</label>
									<input class="form-control" value="<?php echo $r['merchant_type']; ?>" disabled></input>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-lg-6">
								<div class="form-group" style="margin-top:0px;">
									<label>Alamat (Surat)</label>
									<textarea class="form-control" disabled><?php echo $r['address2']; ?></textarea>
								</div>
							</div>

							<div class="col-lg-6">
								<div class="form-group" style="margin-top:-30px;">
									<form action="merchant_action.php?task=update&id=<?php echo $id;?>&kode=<?php echo $mid;?>" class="form-horizontal" id="formMerchant1" name="formMerchant1" method="POST">
										<label>Status Langganan Listrik</label>
										<select class="form-control" name="sts" id="sts">
											<option value="<?php echo $e_sts;?>"><?php echo $e_sts;?></option>
											<option value="Aktif">Aktif</option>
											<option value="Tidak Aktif">Tidak Aktif</option>
										</select><br />
										<button type="submit" class="btn btn-block btn-primary btn-sm"><i class="fa fa-save"></i>&nbsp;&nbsp;Simpan</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php }?>
				<br />
				<div class="row">
					<div class="col-lg-6">
						<div class="panel panel-red">
							<div class="panel-heading">
								<i class="fa fa-clock-o fa-fw"></i> Histori Outstanding Pembayaran Listrik
							</div>
							<div class="panel-body">
								<table id="historyoutstanding" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="width:5%;text-align:center;">NO</th>
											<th style="width:5%;text-align:center;">TAGIHAN</th>
											<th style="width:15%;text-align:center;">PERIODE</th>
											<th style="width:10%;text-align:center;">BIAYA</th>
											<th style="width:12%;text-align:center;">STATUS</th>
											<th style="width:10%;text-align:center;">TAGIHAN</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql 	= "select * from e_pay where merchant_id = '".$mid."' and pay_sts != 'Lunas' order by pay_id desc limit 10";
										$query 	= mysql_query($sql);
										$no		= 1;
										$angs	= 0;
										while($r=mysql_fetch_array($query)){
											$periode = executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
										?>
										<tr>
											<td style="vertical-align: middle; text-align:center;"><?php echo $no; ?></td>
											<td style="vertical-align: middle; vertical-align: middle; text-align:center;"><?php echo 'TL' . $r['pay_id']; ?></td>
											<td style="vertical-align: middle; text-align:center;"><?php echo $periode ?></td>
											<td style="vertical-align: middle; text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
											<td style="vertical-align: middle; text-align:center;"><?php echo $r['pay_sts']; ?></td>
											<td style="vertical-align: middle; text-align:center;">
												<center><a style="text-decoration: none" href="htmltopdf/merchant_bill2.php?id=<?php echo $r['pay_id']; ?>" target="_blank">
													<button class="btn btn-outline btn-primary btn-block btn-xs"><i class="fa fa-print"></i>&nbsp;Cetak</button></a>
												</center>
											</td>
										</tr>
										<?php $no++;} ?>
									</tbody>
								</table>
							</div> 
						</div>
					</div>
				
					<div class="col-lg-6">
						<div class="panel panel-green">
							<div class="panel-heading">
								<i class="fa fa-clock-o fa-fw"></i> Histori Pembayaran Listrik
							</div>
							<div class="panel-body">
								<table id="historybayar" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
											<th style="vertical-align: middle; width:5%;text-align:center;">NO</th>
											<th style="vertical-align: middle; width:5%;text-align:center;">TAGIHAN</th>
											<th style="vertical-align: middle; width:15%;text-align:center;">PERIODE</th>
											<th style="vertical-align: middle; width:10%;text-align:center;">BIAYA</th>
											<th style="vertical-align: middle; width:12%;text-align:center;">TGL BAYAR</th>
											<th style="vertical-align: middle; width:10%;text-align:center;">KWITANSI</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$sql 	= mysql_query("select * from e_pay where merchant_id = '".$mid."' and pay_sts = 'Lunas' order by pay_id desc limit 10");
										$no		= 1;
										$angs	= 0;
										while($r=mysql_fetch_array($sql)){
											$periode = executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
										?>
										<tr>
											<td style="vertical-align: middle; text-align:center;"><?php echo $no; ?></td>
											<td style="vertical-align: middle; text-align:center;"><?php echo 'TL' . $r['pay_id']; ?></td>
											<td style="vertical-align: middle; text-align:center;"><?php echo $periode; ?></td>
											<td style="vertical-align: middle; text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
											<td style="vertical-align: middle; text-align:center;"><?php echo date("d M Y", strtotime($r['pay_date'])); ?></td>
											<td style="vertical-align: middle; text-align:right;">
												<center><a style="text-decoration: none" href="htmltopdf/merchant_bill3.php?id=<?php echo $r['pay_id']; ?>" target="_blank">
													<button class="btn btn-outline btn-primary btn-block btn-xs"><i class="fa fa-print"></i>&nbsp;Cetak</button>
												</a></center>
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
		<!-- Sweet Alert -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
		<?php
			// Menampilkan SweetAlert jika session success ada dan bernilai true
			if (isset($_SESSION['success'])) {
				$title = $_SESSION['title'];
				$message = $_SESSION['message'];
				$icon = $_SESSION['success'] ? 'success' : 'error';
				echo "<script>
					Swal.fire({
						title: '$title',
						text: '$message',
						icon: '$icon'
					});
				</script>";
				unset($_SESSION['success']);
				unset($_SESSION['message']);
			}
		?>
	</body>
</html>