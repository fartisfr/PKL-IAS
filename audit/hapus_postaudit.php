<?php
    include('koneksi.php');
    //get id
    $id = $_GET['id'];
    $query = "DELETE FROM postaudit WHERE kode = '$id'";
    if($connection->query($query)) {
        header("location: ./postaudit.php");
    } else {
        echo "DATA GAGAL DIHAPUS!";
    }
?>