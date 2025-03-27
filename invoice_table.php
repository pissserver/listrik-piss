<?php
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function(){
	$('#historyoutstanding').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<!-- <h3>Daftar Tagihan Listrik</h3> -->
	<table id="historyoutstanding" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th style="vertical-align: middle; width:8%;text-align:center;">NO</th>
				<th style="vertical-align: middle; width:8%;text-align:center;">TAGIHAN</th>
				<th style="vertical-align: middle; width:8%;text-align:center;">KODE</th>
				<th style="vertical-align: middle; width:25;text-align:center;">PENGGUNA LISTRIK</th>
				<th style="vertical-align: middle; width:15%;text-align:center;">PERIODE</th>
				<th style="vertical-align: middle; width:15%;text-align:center;">BIAYA</th>
				<th style="vertical-align: middle; width:15%;text-align:center;">STATUS</th>
				<th style="vertical-align: middle; width:10%;text-align:center;">AKSI</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql 	= "select * from e_pay where pay_sts != 'Lunas' order by pay_id desc";
			$query 	= mysql_query($sql);
			$no		= 1;
			$angs	= 0;
			while($r=mysql_fetch_array($query)){
				$periode = executeScalar("select periode_name from e_periode where periode_id = '".$r['periode_id']."'");
				$name	 = executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
			?>
			<tr>
				<td style="text-align:center;"><?php echo $no; ?></td>
				<td style="text-align:center;"><?php echo 'TL' . $r['pay_id']; ?></td>
				<td style="text-align:center;"><?php echo $r['merchant_id']; ?></td>
				<td style="text-align:left;"><?php echo $name; ?></td>
				<td style="text-align:center;"><?php echo $periode; ?></td>
				<td style="text-align:right;"><?php echo format_rupiah($r['pay_total']); ?></td>
				<td style="text-align:center;"><?php echo $r['pay_sts']; ?></td>
				<td>
					<center><a href="htmltopdf/merchant_bill2.php?id=<?php echo $r[0]; ?>" target="_blank">
						<button class="btn btn-primary btn-block btn-xs"><i class="fa fa-print"></i>&nbsp;&nbsp;Cetak</button>
					</a></center>
				</td>
			</tr>
			<?php $no++;} ?>
		</tbody>
	</table>