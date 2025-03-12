<?php
    include "connection.php";
    if (isset($_POST['merchant'])) {
        $merchant = $_POST["merchant"];
        $sql    = " select lapak.lapak_id as id_lapak, lapak.lapak_name as nama_lapak 
                    from rent
                    join lapak ON lapak.lapak_id = rent.lapak_id 
                    where rent.merchant_id = '".$merchant."' AND
                        ( rent_sts != 'Batal' AND rent_sts2 != 'Batal' )";
        $hasil  = mysql_query($sql);
        if($hasil === FALSE) { 
            trigger_error(mysql_error(), E_USER_ERROR);
        }
        ?>
            <option value="" selected disabled> -- Pilih Lapak --</option>            
        <?php
            while ($data = mysql_fetch_array($hasil)) {
        ?>
                <option value="<?php echo  $data['id_lapak']; ?>"><?php echo $data['nama_lapak']; ?></option>
            <?php
        }
    }
?>