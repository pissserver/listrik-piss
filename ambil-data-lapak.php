<?php
    include "connection.php";
    if (isset($_POST['merchant'])) {
        $merchant = $_POST["merchant"];
        $sql    = " select l.lapak_id as id_lapak, l.lapak_name as nama_lapak 
                    from rent r
                    join lapak l ON l.lapak_id = r.lapak_id 
                    where r.merchant_id = '".$merchant."' AND (r.rent_sts != 'Batal' AND r.rent_sts2 NOT IN ('Batal', 'Pindah'))";
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