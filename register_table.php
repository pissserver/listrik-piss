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
<h3><center>Data Pengguna Listrik PISS</center></h3></br>
<table id="merchantView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;text-align:center;">No</th>
			<th style="text-align:center;">Pedagang</th>
			<th style="text-align:center;">Lapak Pasang</th>
			<th style="text-align:left">Petugas</th>
			<th style="text-align:center;">Daya</th>
			<th style="text-align:center;">Tarif</th>
			<th style="text-align:center;">Status</th>
			<th style="text-align:center;">Aksi</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$query 	= mysql_query("select * from electricity order by electricity_id desc");
			$no		= 1;
			while($data=mysql_fetch_array($query)){
				$price 			= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$data['e_cost_id']."'");
				$ampere 		= executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$data['e_cost_id']."'");
				$name 			= executeScalar("select merchant_name from merchant where merchant_id = '".$data['merchant_id']."'");
				$petugas 		= executeScalar("select checker_name from checker where checker_id = '".$data['id_petugas']."'");
				$lapakpasang	= executeScalar("select lapak_name from lapak where lapak_id = '".$data['id_lapak_dipasang']."'");
		?>
		<tr>
			<td style="text-align:right;"><?php echo $no; ?></td>
			<td><?php echo $data['merchant_id']." - ".$name; ?></td>
			<td><?php echo $lapakpasang; ?></td>
			<td><?php echo $petugas; ?></td>
			<td style="text-align:right;"><?php echo $ampere; ?> Amp</td>
			<td style="text-align:right;"><?php echo format_rupiah($price); ?></td>
			<td style="text-align:center;"><?php echo $data['electricity_sts']; ?></td>
			<td><center>
			<a href="register_edit.php?id=<?php echo $data['electricity_id']; ?>">
				<button class="btn btn-outline btn-primary btn-block btn-xs">Ubah</button>
			</a>
			</center></td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>