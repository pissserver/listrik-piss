<?php
	include "../connection.php";
	//$year 		= date("y");
	$date 		= date("d/m/y");
	$tlid		= 0;
	$id			= 0;
	$sql		= '';
	$note		= executeScalar("select note_text from note where note_id = '1'");
	$sql 		= mysql_query("	select 	e.electricity_id,
										e.merchant_id, 
										e.e_cost_id,
										e.id_lapak_dipasang, 
										l.lapak_name, 
										m.merchant_name, 
										m.merchant_nick 
								from 	electricity e, 
										merchant m, 
										rent r, 
										lapak l 
								where 	e.merchant_id = m.merchant_id and
										m.merchant_id = r.merchant_id and
										r.lapak_id = l.lapak_id and 
										e.electricity_sts = 'Aktif' and
										(r.rent_sts2 != 'Pindah' && r.rent_sts2 != 'Batal') 
								group by e.electricity_id 
								order by l.block_id, l.lapak_no");
	while($r=mysql_fetch_array($sql)){
		$ampere 	= executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$r['e_cost_id']."'");
		$price 		= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$r['e_cost_id']."'");
		$periode 	= executeScalar("select periode_name from e_periode where periode_id = '".$_POST['periode']."'");
		$year	 	= executeScalar("select periode_year from e_periode where periode_id = '".$_POST['periode']."'");
		$month	 	= executeScalar("select periode_month from e_periode where periode_id = '".$_POST['periode']."'");
		$lapak 		= executeScalar("select lapak_name from lapak where lapak_id = '".$r['id_lapak_dipasang']."'");
		$year1		= substr($year, -2);
		//check jika tagihan sudah ada / blm
		$ada = executeScalar("	select 	count(pay_id) 
								from 	e_pay 
								where 	merchant_id = '".$r['merchant_id']."' and
										electricity_id = '".$r['electricity_id']."' and
										periode_id = '".$_POST['periode']."'");
		if($ada==0){ //jika tidak ada / blm dicetak
			$count 	= executeScalar("select count(periode_id) from e_pay where periode_id = '".$_POST['periode']."'");
			//Generate ID
			$count	= $count+1;
			$count 	= sprintf("%03d", $count);
			$id		= $year1.$month.$count;
			$insert = mysql_query("	insert into e_pay (	`pay_id`, 
														`electricity_id`,
														`merchant_id`,
														`id_lapak_dipasang`, 
														`periode_id`, 
														`pay_total`, 
														`pay_sts`) 
									VALUES ('".$id."', 
											'".$r['electricity_id']."',
											'".$r['merchant_id']."',
											'".$r['id_lapak_dipasang']."', 
											'".$_POST['periode']."', 
											'".$price."', 
											'Belum Lunas')");
			//$tlid = mysql_insert_id();
		}else{//jika sdh ada
			$id 	= executeScalar("	select 	pay_id 
										from 	e_pay 
										where 	merchant_id = '".$r['merchant_id']."' and
												electricity_id = '".$r['electricity_id']."' and 
												periode_id = '".$_POST['periode']."'");
		}
		//$tlid 		= sprintf("%07d", $id);
?>
<page backtop="5mm" backbottom="15mm" backleft="5mm" backright="5mm">
	<page_header>
    </page_header>
	<table style="width:95%; border:0px; margin-top:0px; margin-left:5px; margin-right:5px; font-size:8pt;">
		<tr>
			<td style="text-align: left; width: 50%"><?php echo 'TL'.$id; ?></td>
			<td style="text-align: center; width: 5%"></td>
			<td style="text-align: right; width: 45%"><?php echo date("d-m-Y", strtotime($date_now)); ?></td>
			<!-- <td style="text-align: right; width: 45%">01-09-2024</td> -->
		</tr>
	</table>
	<br />
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:5px; margin-bottom:15px;">
		Tagihan Listrik PISS
	</div>
	<table style="margin-bottom: 5px;font-size:11pt;" id="tableCheckout">
		<tr><td>Nama 				</td><td> : <?php echo $r['merchant_name']; ?> </td></tr>
		<tr><td>Nama Alias			</td><td> : <?php echo $r['merchant_nick']; ?> </td></tr>
		<tr><td>Lapak				</td><td> : <?php echo $lapak; ?> </td></tr>
		<tr><td>Daya Yg Digunakan	</td><td> : <?php echo $ampere; ?> Ampere</td></tr>
		<tr><td>Periode Tagihan		</td><td> : <?php echo $periode; ?></td></tr>
		<tr><td>Jumlah Tagihan		</td><td> : <b><?php echo format_rupiah($price); ?></b></td></tr>
	</table>
    <br/><br/>
	<?php 
		if($note!=''){
			echo $note;
		}
	?>
    <br/>
	
    <page_footer>
		<table style="width: 95%; border: 0px black; margin-top:0px; margin-bottom:30px; margin-right:5px; font-size:8pt;">
			<tr>
				<td style="text-align: center;width: 45%">(TTD & Nama Petugas)</td>
				<td style="text-align: center;width: 65%">(TTD Pelanggan)</td>
			</tr>
		</table>
	<br />
    </page_footer>
</page>
<?php } ?>