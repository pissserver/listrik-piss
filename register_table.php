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
<!-- <h3><center>Data Pengguna Listrik PISS</center></h3></br> -->
<table id="merchantView" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
	<thead>
		<tr>
			<th style="width:10%;text-align:center;">NO</th>
			<th style="text-align:center;">KODE</th>
			<th style="text-align:center;">PEDAGANG</th>
			<th style="text-align:center;">LAPAK</th>
			<th style="text-align:center;">DAYA</th>
			<th style="text-align:center;">TARIF</th>
			<th style="text-align:center;">STATUS</th>
			<th style="text-align:left">PETUGAS</th>
			<th style="text-align:center;">AKSI</th>
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
			<td style="vertical-align: middle; text-align:center;"><?php echo $no; ?></td>
			<td style="vertical-align: middle; text-align:center;"><?php echo $data['merchant_id']; ?></td>
			<td style="vertical-align: middle; text-align:left;"><?php echo $name; ?></td>
			<td style="vertical-align: middle; text-align:center;"><?php echo $lapakpasang; ?></td>
			<td style="vertical-align: middle; text-align:center;"><?php echo $ampere; ?> Amp</td>
			<td style="vertical-align: middle; text-align:right;"><?php echo format_rupiah($price); ?></td>
			<td style="vertical-align: middle; text-align:center;">
				<div style="vertical-align: middle; background-color: <?php echo $data['electricity_sts'] == 'Tidak Aktif' ? 'red' : 'green'; ?>; color: #fff; padding: 3px; border-radius: 5px; margin: 5px auto 5px auto; width: 110px;">		
					<i class="fa <?php echo $data['electricity_sts'] == 'Tidak Aktif' ? 'fa-remove' : 'fa-check'; ?>"></i>&nbsp;<?php echo $data['electricity_sts']; ?>
				</div>
			</td>
			<td style="vertical-align: middle; text-align:center;">
				<div style="vertical-align: middle; background-color: <?php echo $data['id_petugas'] == '26' ? '#428bca' : 'green'; ?>; color: #fff; padding: 3px; border-radius: 5px; margin: 5px auto 5px auto; width: 110px;">		
					<?php echo $petugas; ?>
				</div>
			</td>
			<td style="vertical-align: middle; text-align:center;"><center>
				<a style="text-decoration: none" class="btn btn-outline btn-block btn-primary btn-xs modalEditRegister" data-toggle="modal" data-target="#modalEditRegister" data-id="<?php echo $data['electricity_id']; ?>">
					<i class="fa fa-edit"></i>&nbsp;&nbsp;Edit
				</a>
				<a style="text-decoration: none" class="btn btn-outline btn-block btn-danger btn-xs modalDeleteRegister" data-toggle="modal" data-target="#modalDeleteRegister" data-id="<?php echo $data['electricity_id']; ?>">
					<i class="fa fa-trash"></i>&nbsp;&nbsp;Hapus
				</a>
			</center></td>
		</tr>
		<?php $no++;} ?>
	</tbody>
</table>

<script>
	$(document).ready(function() {
		$('body').on('click', '.modalEditRegister', function() {
			var registerID = $(this).data('id'); 

			$.ajax({
				url: 'register_modal.php',
				type: 'GET',
				data: { id: registerID }, 
				success: function(response) {
					$('#modalEditRegister .modal-content').html(response);
					$('#modalEditRegister').modal('show');
				}
			});
		});
	});

	$('body').on('click', '.modalDeleteRegister', function() {
			var registerID = $(this).data('id'); 

			$.ajax({
				url: 'register_delete_modal.php',
				type: 'GET',
				data: { id: registerID }, 
				success: function(response) {
					$('#modalDeleteRegister .modal-content').html(response);
					$('#modalDeleteRegister').modal('show');
				}
			});
		});
</script>