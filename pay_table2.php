<?php
	session_start();
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function(){
	$('#payView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<table id="payView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;text-align:center;">No</th>
			<th style="width:25%;text-align:center;">Nama Pelanggan</th>
			<th style="width:15%;text-align:center;">Periode Tagihan</th>
			<th style="width:12%;text-align:center;">Tanggal Bayar</th>
			<th style="width:10%;text-align:center;">Jumlah Bayar</th>
			<th style="width:10%;text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql 	= mysql_query("select * from e_pay where pay_sts = 'Lunas' order by pay_id desc");
		$no		= 1;
		$angs	= 0;
		while($r=mysql_fetch_array($sql)){
			$periode	= executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
			$name		= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
			$nick 	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td style="text-align:left;"><?php echo $name.' / '.$nick; ?></td>
			<td style="text-align:center;"><?php echo $periode; ?></td>
			<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
			<td style="text-align:center;"><?php echo $r['pay_date']; ?></td>
			<td>
				<?php 
					if($_SESSION['role']=='Cashier'){
						
					}
					else{
						echo '<a href="pay_action.php?task=batal&id='.$r['pay_id'].'"><button class="btn btn-xs btn-outline btn-primary btn-block">Batalkan Pembayaran</button></a>';
					}
				?>
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>