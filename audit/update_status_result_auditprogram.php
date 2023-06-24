<?php

//include koneksi database
include('koneksi.php');

//get data dari form
$kode = $_POST['kode'];
$statuspr = $_POST['statuspr'];

//query update data ke dalam database berdasarkan ID
$query = "UPDATE auditprogram SET statuspr = '$statuspr'
WHERE kode = '$kode'";
// echo $query;
$connection->query($query)
// //kondisi pengecekan apakah data berhasil diupdate atau tidak
// if($connection->query($query)) {
//     //redirect ke halaman index.php 
//     header("location: ./auditplan.php");
// } else {
//     //pesan error gagal update data
//     echo "Data Gagal Diupate!";
// }

?>