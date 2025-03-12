<?php
	session_start();
	include "connection.php";
?>
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
		$('#merchantView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<h3>Tagihan Listrik PIOS</h3>
<table id="merchantView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:5%;text-align:center;">No</th>
			<th style="width:30%;">Nama</th>
			<th style="width:12%;text-align:center;">Periode</th>
			<th style="width:10%;text-align:center;">Daya</th>
			<th style="width:10%;text-align:center;">Biaya</th>
			<th style="width:12%;text-align:center;">Status</th>
			<th style="width:10%;text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql 	= "select * from e_pay where pay_sts = 'Belum Lunas' order by pay_id desc";
			$query 	= mysql_query($sql);
			$no		= 1;
			$angs	= 0;
			while($r=mysql_fetch_array($query)){
				$name 	= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
				$periode= executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
				$cost_id = executeScalar("select e_cost_id from electricity where merchant_id = '".$r['merchant_id']."'");
				$ampere = executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$cost_id."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td><?php echo $name; ?></td>
			<td style="text-align:center;"><?php echo $periode; ?></td>
			<td style="text-align:right;"><?php echo $ampere; ?> Ampere</td>
			<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
			<td style="text-align:center;"><?php echo $r['pay_sts']; ?></td>
			<td>
			<?php 
				if($_SESSION['role']=='Cashier'){
					
				}
				else{
					echo '<center><a href="pay_action.php?task=absen&id='.$r['pay_id'].'">
					<button class="btn btn-outline btn-primary btn-block btn-xs">Batalkan Tagihan</button>
				</a></center>';
				}
			?>
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>