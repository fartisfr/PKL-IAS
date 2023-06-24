<?php

//include koneksi database
include('koneksi.php');


//get data dari form
$kode = $_POST['kode'];
$strategy = $_POST['strategy'];
$program = $_POST['program'];
$tools = $_POST['tools'];
$schedule = $_POST['schedule'];
$statuspr = $_POST['statuspr'];
$result = $_POST['result'];
$note = $_POST['note'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE auditprogram SET strategy = '$strategy', program = '$program', tools = '$tools', schedule = '$schedule', statuspr = '$statuspr', result = '$result', note = '$note' WHERE kode = '$kode'";

//kondisi pengecekan apakah data berhasil diupdate atau tidak
if ($connection->query($query)) {
    //redirect ke halaman index.php 
    header("location: ./auditprogram.php");
} else {
    //pesan error gagal update data
    echo "Data Gagal Diupate!";
}
?>

