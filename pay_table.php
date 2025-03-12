<?php
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
<h3>Tagihan Listrik PISS</h3>
<table id="merchantView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:6%;text-align:center;">NO</th>
			<th style="width:8%;text-align:center;">KODE TAGIHAN</th>
			<th style="width:30%;text-align:center;">NAMA</th>
			<th style="width:12%;text-align:center;">PERIODE</th>
			<th style="width:10%;text-align:center;">DAYA</th>
			<th style="width:10%;text-align:center;">BIAYA</th>
			<th style="width:12%;text-align:center;">STATUS</th>
			<th style="width:10%;text-align:center;">AKSI</th>
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
			$nick 	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
			$tarif 	= executeScalar("select e_cost_id from electricity where merchant_id = '".$r['merchant_id']."'");
			$periode= executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
			$price 	= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$tarif."'");
			$ampere = executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$tarif."'");
			$jml 	= executeScalar("select pay_total from e_pay where pay_id = '".$r['pay_id']."'");
			
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:center;"><?php echo "TL".$r['pay_id']; ?></td>
			<td style="text-align:left;"><?php echo $name.' / '.$nick; ?></td>
			<td style="text-align:center;"><?php echo $periode; ?></td>
			<td style="text-align:right;"><?php echo $ampere; ?> Ampere</td>
			<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
			<td style="text-align:center;"><?php echo $r['pay_sts']; ?></td>
			<td>
				<!-- Button HTML (to Trigger Modal) -->
				<a href="pay_modal.php?id=<?php echo $r['pay_id']; ?>" class="btn btn-xs btn-outline btn-primary btn-block" data-toggle="modal" data-target="#modalPay">Bayar</a>
			</td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>