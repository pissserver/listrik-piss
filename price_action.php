<?php
    session_start();
    include "connection.php";

    $task   = $_GET['task'];
    $id     = $_GET['id'];
    $merchant_id = $_GET['merchant'];
    $electricity_id = $_GET['eid'];

    // Update
    if($task=='update'){
        $update = mysql_query("update e_pay set pay_total = '".$_POST['price']."' where pay_id = '".$id."'");
        if($update){
            // Alert Information
            $_SESSION['success'] = true;
            $_SESSION['title'] = 'Berhasil';
            $_SESSION['message'] = "Update Biaya Tagihan";
            echo "<script>window.location=('merchant_edit.php?id=".$electricity_id."&kode=".$merchant_id."')</script>";
            exit();
        }
        else{
            // Alert Information
            $_SESSION['success'] = false;
            $_SESSION['title'] = 'Gagal';
            $_SESSION['message'] = "Update biaya tagihan";
            echo "<script>window.history.back()</script>";
            exit();
        }
    }

?>