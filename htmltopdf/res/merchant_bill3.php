<?php
	include "../connection.php";
	$id			= $_GET['id'];
	$year 		= date("y");
	$date 		= date("d/m/y");
	$tlid		= 0;
	
	$sql 		= mysql_query("select * from e_pay where pay_id = '".$id."' order by pay_id desc");
	while($r=mysql_fetch_array($sql)){
		$tlid 	= sprintf("%07d", $id);
		$name	= executeScalar("select merchant_name from merchant where merchant_id = '".$r['merchant_id']."'");
		$nick	= executeScalar("select merchant_nick from merchant where merchant_id = '".$r['merchant_id']."'");
		$lid	= executeScalar("select lapak_id from rent where merchant_id = '".$r['merchant_id']."' and (rent_sts2 != 'Pindah' && rent_sts2 != 'Batal')");
		$lapak	= executeScalar("select lapak_name from lapak where lapak_id = '".$lid."'");
		$ampere = executeScalar("select e_cost_ampere from e_cost where e_cost_id = '".$r['e_cost_id']."'");
		$price 	= executeScalar("select e_cost_price from e_cost where e_cost_id = '".$r['e_cost_id']."'");
		$periode= $r['periode_id'];
		$pname	= executeScalar("select periode_name from e_periode where periode_id = '".$periode."'");
		$note	= executeScalar("select note_text from note where note_id = '1'");
		//jika lebih dr 2 ampere, biaya dibagi 2
		if($tarif!=1){
			$price	= $price/2;
		}
		//untuk mencegah error periode = 0 || tahun = 0
		if($periode==0||$pname==0){
			echo "<script>window.history.back()</script>";
			exit();
		}
?>
<page backtop="5mm" backbottom="5mm" backleft="5mm" backright="5mm">
	<page_header>
    </page_header>
	<table style="width:95%; border:0px; margin-top:0px; margin-left:5px; margin-right:5px; font-size:8pt;">
		<tr>
			<td style="text-align: left; width: 50%"><?php echo 'TL'.$tlid; ?></td>
			<td style="text-align: center; width: 5%"></td>
			<td style="text-align: right; width: 45%"><?php echo $date_now; ?></td>
		</tr>
	</table>
	<br />
    <div style="font-size: 14px; font-weight: bold; text-align: center; margin-top:5px; margin-bottom:15px;">
		Bukti Pembayaran Listrik PIOS
	</div>
	<?php  ?>
	<table style="margin-bottom: 5px;font-size:11pt;" id="tableCheckout">
		<tr><td>Nama 				</td><td> : <?php echo $name; ?> </td></tr>
		<tr><td>Nama Alias			</td><td> : <?php echo $nick; ?> </td></tr>
		<tr><td>Lapak				</td><td> : <?php echo $lapak; ?> </td></tr>
		<tr><td>Daya Yg Digunakan	</td><td> : <?php echo $ampere; ?> Ampere</td></tr>
		<tr><td>Periode Tagihan		</td><td> : <?php echo date("d-m-Y", strtotime($pname)); ?></td></tr>
		<tr><td>Tanggal Bayar		</td><td> : <?php echo date("d-m-Y", strtotime($r['pay_date'])); ?></td></tr>
		<tr><td>Jumlah Bayar		</td><td> : <b><?php echo format_rupiah($r['pay_total']); ?></b></td></tr>
		<tr><td>Status Bayar		</td><td> : <?php echo $r['pay_sts']; ?></td></tr>
	</table>
    <br/><br/>
	<?php 
		if($note!=''){
			echo $note;
		}
	?>
    <br/>
	<page_footer>
		<table style="width: 95%; border: 0px black; margin-top:10px; margin-bottom:30px; margin-right:5px; font-size:8pt;">
			<tr>
				<td style="text-align: center;width: 45%">(TTD & Nama Petugas)</td>
				<td style="text-align: center;width: 65%">(TTD Pelanggan)</td>
			</tr>
		</table>
    </page_footer>
</page>
<?php } ?>