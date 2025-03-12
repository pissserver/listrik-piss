<?php
	include "connection.php";
?>
<!-- jquery -->
<script src="dataTables/jquery.dataTables.js"></script>
<script src="dataTables/dataTables.tableTools.js"></script>
<script src="dataTables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
	//data table
	$('#lapakView').dataTable({"aLengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]]});
	});
</script>
<H3 style="text-align:center; margin-top:-10px;">PERLENGKAPAN LISTRIK PISS</H3>
<table id="lapakView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="text-align:center;">NO</th>
			<th style="text-align:center;">PERLENGKAPAN</th>
			<th style="text-align:center;">HARGA</th>
			<th style="text-align:center;">AKSI</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$sql 	= mysql_query("select * from e_tools order by e_tools_name");
			$no		= 1;
			while($data=mysql_fetch_array($sql)){
		?>
		<tr>
			<td style="text-align:center;"><?php echo $no; ?></td>
			<td style="text-align:left"><?php echo $data['e_tools_name']; ?></td>
			<td style="text-align:right"><?php echo format_rupiah($data['e_tools_price']); ?></td>
			<td><center>
				<a href="tarif_edit2.php?id=<?php echo $data['e_tools_id']; ?>">
					<button class="btn btn-outline btn-block btn-primary btn-xs">Edit</button>
				</a>
			</center></td>
		</tr>
		<?php
			$no++;
			}
		?>
	</tbody>
</table>