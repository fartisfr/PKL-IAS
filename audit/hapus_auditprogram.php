<?php
    include('koneksi.php');
    //get id
    $id = $_GET['id'];
    $query = "DELETE FROM auditprogram WHERE kode = '$id'";
    if($connection->query($query)) {
        header("location: ./auditprogram.php");
    } else {
        echo "DATA GAGAL DIHAPUS!";
    }
?>